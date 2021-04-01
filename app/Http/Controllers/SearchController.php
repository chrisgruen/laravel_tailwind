<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Arr;
use Helper;

class SearchController extends Controller
{
    //
    public function search()
    {
        return view('auction.searchMask');
    }

    public function ajaxSearch(Request $request)
    {
        $new = array();
        $bidden = array();
        $request->auctionState = 'running';

        $list = SearchController::searchEngine($request);

        foreach ($list as $state => $objects) {
            foreach ($objects as $object) {
                $item = array();
                $item['titlePictureURL'] = URL::to('storage/images/' . \App\Models\ObjectImage::getTitlePicture($object->titlePictureID) . '-h200.jpg');
                $item['company_id'] = $object->company_id;
                $item['url'] = $object->url;
                $item['title'] = $object->title;
                $item['name'] = $object->name;
                $item['marketType'] = $object->marketType;
                $item['marketForm'] = $object->marketForm;
                $item['subType'] = $object->subType;
                $item['abstract'] = $object->abstract;
                $item['type'] = trans('messages.' . $object->subType);
                $item['location'] = $object->street . ' ' .$object->street_number . ', ' . "<span class='text-nowrap'>" . $object->zipcode . " " . $object->city. "</span>";
                $item['plot'] = "";

                $plot = array();

                switch ($object->type) {
                    case "flat":
                        if (!empty($object->estateSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.estateSize') . " " . $object->estateSize . " m² </span>";

                        if (!empty($object->livingAreaSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.livingArea') . " " . $object->livingAreaSize." m² </span>";

                        if (!empty($object->$object->rooms))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.rooms') . " " . $object->rooms."</span>";
                        break;

                    case "house":
                        if (!empty($object->estateSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.estateSize') . " " . $object->estateSize . " m² </span>";
                        
                        if (!empty($object->livingAreaNetSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.livingArea') . " " . ($object->livingAreaNetSize + $object->workAreaNetSize)." m² </span>";

                        if (!empty($object->$object->rooms))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.rooms') . " " . $object->rooms."</span>";
                        break;

                    case "estate":
                    case "build_estate":
                    case "unbuild_estate":
                        if (!empty($object->estateSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.estateSize') . " " . $object->estateSize . " m² </span>";
                        break;

                    case "commercial":
                        if (!empty($object->totalAreaSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.totalAreaSize') . " " . $object->totalAreaSize . " m² </span>";

                        if (!empty($object->estateSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.estateSize') . " " . $object->estateSize . " m² </span>";
                        break;

                    case "parking":
                        if (!empty($object->totalAreaSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.totalAreaSize') . " " . $object->totalAreaSize . " m² </span>";

                        if (!empty($object->estateSize))
                            $plot[] = "<span class='text-nowrap'>".trans('messages.estateSize') . " " . $object->estateSize . " m² </span>";

                        break;
                }
                $item['plot'] = implode(' | ', $plot);
                $item['conceptRequired'] = $object->conceptRequired;
                $item['ratingRequired'] = $object->ratingRequired;
                $item['bid_status'] = $object->bid_status;
                $item['own_bid'] = number_format($object->own_bid, 2, ',', '.');
                $item['biddingEnd'] = date('d.m.Y | H:i', strtotime($object->biddingEnd));
                $item['offerBegin'] = date('d.m.Y', strtotime($object->offerBegin));
                $item['offerEnd'] = date('d.m.Y', strtotime($object->offerEnd));
                if ($state == "newBid")
                    $new[] = $item;
                else
                    $bidden[] = $item;
            }
        }
        $request->session()->forget('last_search');
        $request->session()->put('last_search', $request->all());

        $perPage = config('constants.per_page');
        $dataNew = collect($new)->paginate($perPage, $total = null, $page = null, $pageName = 'p_new');
        $dataBidden = collect($bidden)->paginate($perPage, $total = null, $page = null, $pageName = 'p_bidden');
        $entries = collect(["newBid" => $dataNew, "bidden" => $dataBidden]);

        $html = view('auction.partials.searchResultList', ['auctions' => $entries, 'app_url' => $request->app_url])->render();
        return response($html);
    }

    public function searchEngine($searchParamsObject)
    {
        $bidden = array();
        $new = array();

        if (Auth::check()) {
            $temp = Bidding::select(\DB::raw('distinct(auctionID) as auctionID'))->where('userID', '=', Auth::id());
            $own_bid = $temp->get();
            $auction_ids = array();
            foreach ($own_bid->all() as $own) {
                $auction_ids[] = $own->auctionID;
            }
        } else {
            $auction_ids = array();
        }

        if($searchParamsObject->searchtype != null && $searchParamsObject->searchtype == 'marketType') {
            $searchParamsObject->type = Null;
            $searchParamsObject->subType = Null;
            $searchParamsObject->radius = Null;
            $searchParamsObject->immoLocation = Null;
        }

        /* handle geo-search */
        $search_state = Null;
        $geoData = Null;
        if ($searchParamsObject->immoLocation != null) {
            $location_split = explode(",", $searchParamsObject->immoLocation);
            $zipcode = $location_split[0];
            if (!preg_match('/^\d/', $searchParamsObject->immoLocation)) {
                $search_state = substr($searchParamsObject->immoLocation, 0, -4);
            } else {
                $geoData = Geo::where('zipCode', '=', $zipcode)->first();
            }
        }
        $search_radius = isset($searchParamsObject->radius) ? $searchParamsObject->radius : 0;

        /* Check Subdomain */
        $sub = Arr::first(explode('.', request()->getHost()));
        $comp_id = Company::where('subdomain', $sub)->value('id');

        $temp = Auction::query()->where('auctionState', '=', 'running');
        if ($searchParamsObject->marketType == 'sale' || $searchParamsObject->marketType == 'best_price') {
            $temp = $temp->where('biddingEnd', '>', date('Y-m-d H:m:i'));
        }
        if ($comp_id !== Null)
            $temp = $temp->where('company_id', $comp_id);
        if (!empty($searchParamsObject->marketType) && $searchParamsObject->marketType != '')
            $temp = $temp->where('marketType', '=', $searchParamsObject->marketType);
        if (!empty($searchParamsObject->objectID))
            $temp = $temp->where('name', '=', $searchParamsObject->objectID);
        if (!empty($searchParamsObject->lastRun))
            $temp = $temp->where('published_at', '>', $searchParamsObject->lastRun);
        if (!empty($searchParamsObject->type))
            $temp = $temp->where('type', '=', $searchParamsObject->type);
        if (!empty($searchParamsObject->subType))
            if ($searchParamsObject->marketType == 'build_lease') {
                $temp = $temp->where('marketForm', '=', $searchParamsObject->subType);
            } else {
                $temp = $temp->where('subType', '=', $searchParamsObject->subType);
            }
        if (!empty($searchParamsObject->city))
            $temp = $temp->where('city', 'like', '%' . $searchParamsObject->city . '%');
        if (!empty($searchParamsObject->minSize)) {
            $temp = $temp->where('livingAreaSize', '>', $searchParamsObject->minSize);
            $temp = $temp->where('livingAreaNetSize', '>', $searchParamsObject->minSize);
            $temp = $temp->where('workAreaNetSize', '>', $searchParamsObject->minSize);
        }
        if (!empty($searchParamsObject->maxSize)) {
            $temp = $temp->where('livingAreaSize', '<', $searchParamsObject->maxSize);
            $temp = $temp->where('livingAreaNetSize', '<', $searchParamsObject->maxSize);
            $temp = $temp->where('workAreaNetSize', '<', $searchParamsObject->maxSize);
        }
        if (isset($search_state)) {
            $search_string = Helper::get_search_states($search_state);
            $temp = $temp->where('state', $search_string);
        }

        $list = $temp->get();

        foreach ($list as $key => $auction) {
            if ($searchParamsObject->immoLocation != null) {
                if ($geoData != Null) {
                    /* if radius_search */
                    if ($auction->longitude == "" || $auction->latitude == "") {
                        $target = Geo::where('zipCode', '=', $auction->zipcode)->first();
                        if (empty($target))
                            continue;
                        $auction->latitude = $target->latitude;
                        $auction->longitude = $target->longitude;
                        $auction->save();
                        $radius = round(Geo::vincentyGreatCircleradius($geoData->latitude, $geoData->longitude, $auction->latitude, $auction->longitude));
                        if ($radius > $searchParamsObject->radius) {
                            unset($list[$key]);
                            continue;
                        }
                    } else {
                        $radius = round(Geo::vincentyGreatCircleDistance($geoData->latitude, $geoData->longitude, $auction->latitude, $auction->longitude));
                        if ($auction->zipcode == $geoData->zipcode || $radius < $search_radius) {
                            //dump('find');
                        } else {
                            unset($list[$key]);
                            continue;
                        }
                    }
                } else {
                    if ($search_state == Null) {
                        unset($list[$key]);
                        continue;
                    }
                }
            }

            $auction['url'] = route('auction.detail', ['auctionName' => $auction['name']]);
            if (in_array($auction->id, $auction_ids)) {
                $ownbid = Bidding::evalBids($auction->id);
                $auction['bid_status'] = $ownbid['bid_status'];
                $auction['own_bid'] = $ownbid['own_bid'];
                $bidden[] = $auction;
            } else {
                $new[] = $auction;
            }
        }
        return collect(["newBid" => collect($new), "bidden" => collect($bidden)]);
    }

    /*
     * Autocomplete searchform
     */
    public function autocomplete(Request $request)
    {
        $city_array = [];
        $states_array = [];

        $cities = Geo::select(DB::raw('CONCAT(zipcode, ", ", city, ", ", state, ", ", country_code) AS city'))
            ->where('city', 'like', $request->term . '%')
            ->orWhere('zipcode', 'like', $request->term . '%')
            ->get();

        $states = Geo::select('country_code','state')->where('state', 'like', $request->term . '%')->distinct()->get();

        foreach ($states as $state) {
            $states_array[] = ['value' => $state->state.' ('.$state->country_code.')', 'data' => ['category' => trans('messages.state')]];
        }

        foreach ($cities as $city) {
            $city_array[] = ['value' => $city->city, 'data' => ['category' => trans('messages.plz_city')]];
        }

        $search_array = array_merge($states_array, $city_array);
        $geos = json_encode($search_array);

        return response($geos)->header('Content-Type', 'application/json');
    }
}
