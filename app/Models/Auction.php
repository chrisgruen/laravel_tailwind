<?php

namespace App\Models;

use App\Jobs\Is24;
use App\Notifications\AuctionEndedEmpty;
use App\Notifications\AuctionLost;
use App\Notifications\AuctionWon;
use App\Notifications\AuctionEnded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Arr;
use Helper;

class Auction extends Model {
    protected $fillable = [
        'name', 'title', 'address', 'street', 'street_number', 'city', 'zipcode', 'state', 'auctionState', 'company_id', 'account_id_publish', 'country', 'abstract', 'geometry', 'coordinates',
        'marketForm', 'type', 'subType', 'titlePictureID', 'minPrice', 'estatePrice', 'leaseRuntime', 'interestRate', 'is24state', 'is24estateID', 'is24publish', 'is24removed', 'marketValue', 'biddingEnd', 'offerBegin', 'offerEnd',
        'landRegisterEntries', 'landRegisterMarking', 'landRegisterBurdens', 'landRegisterFloor', 'landRegisterFloorPiece',
        'estateSize', 'livingAreaSize', 'rooms', 'livingAreaNetSize', 'livingConstructionSize', 'workAreaNetSize', 'workConstructionSize',
        'nettoYearLease', 'overheadLease', 'nettoYearRent', 'overhead', "nettoYearRentCurrent", "bruttoYearRent", "bruttoYearRentCurrent", "bruttoYearLease",
        'currentUsage', 'futureUsage', 'objectDescription',
        'macroSituation', 'microSituation', 'redevelopment', 'burdens', 'rentOrLease',
        'constructionYear', 'preservation', 'condition', 'cellar', 'balcony', 'facade', 'windows', 'roof', 'heating', 'sanitary', 'electrical', 'stairs', 'doors', 'sweep', 'faults', 'energy',
        'exploitationInfo', 'waterSupply', 'energySupply', 'gasSupply', 'dataSupply', 'wasteWaterSupply', 'rainWaterSupply', 'phoneSupply',
        'planinglaw', 'contractDetails', 'financeHints', 'financeSelect', 'other', 'contactIDs', 'pollutionControl',
        'ratingRequired', 'ratingMatrix', 'ratingMin', 'sightseeingService', 'boilerplate',
        'conceptRequired', 'conceptType', 'conceptMatrix', 'conceptFactor', 'conceptText', 'latitude', 'longitude', 'marketType', 'marketForm',
        'rentNettoCost', 'rentAdditionalCost', 'rentHeadingCost', 'leaseCost', 'rentDeposit', 'rentDepositCost', 'levelFlat', 'levelFlatCount', 'lift', 'securityService', 'stepByNew',
    ];

    // wohnung haus grundstück stellplatz gewerbe
    public $immoTypes = [
        'flat' => array('apartment', 'galleryFlat', 'groundFloorApartment', 'atticPenthouse', 'levelapartment', 'duplex', 'basementApartment', 'loftStudioStudio', 'holidayFlat'),
        'house' => array('detachedHouse', 'twoFamilyHouse', 'apartmentHouse', 'townrowhouse', 'townhouseEnd', 'townhouse', 'villa', 'holidayHome', 'farmFarmhouse', 'countryHouse', 'semiDetachedHouse', 'bungalow', 'thatchedCottage', 'specialProperties'),
        'estate' => array('residentialLand', 'industrialLand', 'specialUseLand', 'agricultureAndForestryLand', 'otherLand', 'commercialLand', 'recreationalPlot', 'developmentLand'),
        'parking' => array('parkingSpace', 'undergroundParking', 'doubleGarage', 'garage', 'carport'),
        'commercial' => array('officesClinics', 'retailTrade', 'storageProduction', 'hospitalityHotels', 'specialBranch'),
        'build_estate' => array('fixed_price', 'best_price'),
        'unbuild_estate' => array('fixed_price', 'best_price'),
    ];

    public $immoMapper = [
        'parking' => array('garage' => 'GARAGE', 'parkingSpace' => 'STREET_PARKING', 'carport' => 'CARPORT', 'doubleGarage' => 'DUPLEX', 'other' => "NO_INFORMATION", 'undergroundParking' => 'UNDERGROUND_GARAGE'),
        'flat' => array('atticPenthouse' => 'ROOF_STOREY', 'loftStudioStudio' => 'LOFT', 'levelapartment' => 'APARTMENT', 'galleryFlat' => 'PENTHOUSE', 'holidayFlat' => 'TERRACED_FLAT', 'groundFloorApartment' => 'GROUND_FLOOR', 'apartment' => 'APARTMENT', 'dupley' => 'RAISED_GROUND_FLOOR', 'basementApartment' => 'HALF_BASEMENT'),
        'house' => array('detachedHouse' => 'SINGLE_FAMILY_HOUSE', 'twoFamilyHouse' => 'MULTI_FAMILY_HOUSE', 'apartmentHouse' => 'MULTI_FAMILY_HOUSE', 'townrowhouse' => 'MID_TERRACE_HOUSE', 'townhouseEnd' => 'END_TERRACE_HOUSE', 'townhouse' => 'OTHER', 'villa' => 'VILLA', 'holidayHome' => 'OTHER', 'holidayHome' => 'OTHER', 'farmFarmhouse' => 'FARMHOUSE', 'countryHouse' => 'OTHER', 'semiDetachedHouse' => 'SEMIDETACHED_HOUSE', 'bungalow' => 'BUNGALOW', 'thatchedCottage' => 'NO_INFORMATION', 'specialProperties' => 'SPECIAL_REAL_ESTATE'),
        'estate' => array('residentialLand' => 'TRADE', 'industrialLand' => 'TRADE', 'specialUseLand' => 'TRADE', 'agricultureAndForestryLand' => 'AGRICULTURE_FORESTRY', 'otherLand' => 'TRADE', 'commercialLand' => 'TRADE', 'recreationalPlot' => 'LEISURE', 'developmentLand' => 'TRADE'),
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function images() {
        return $this->hasMany('App\Models\ObjectImage', 'auctionID', 'id' );
    }

    public $states = ['baden-Wurttemberg', 'bavaria', 'berlin', 'brandenburg', 'bremen', 'hamburg', 'hesse', 'mecklenburg-Vorpommern', 'lowerSaxony', 'northRhine-Westphalia', 'rheinland-Pfalz', 'saarland', 'saxony', 'saxony-Anhalt', 'schleswig-Holstein', 'thuringia'];

    public static function getRandomAuctions($comp_id) {

        $where = array();
        $where[] = array('auctionState', '=', 'running');

        $ret_val = auction::select('auctions.*')->where($where);
        
        if (Auth::guard('account')->check()) {
            if(!Auth::guard('account')->user()->company->hasRole('admin')) {
                $ret_val = $ret_val->join('companies', 'auctions.company_id', '=', 'companies.id')->where('auctions.company_id', '=', Auth::guard('account')->user()->company_id);
            }
           
        } else {
            if ($comp_id !== Null)
                $ret_val = $ret_val->where('company_id', '=', $comp_id);
        }

       
        $ret_val = $ret_val->inRandomOrder()->limit(10)->get();

        return $ret_val->all();
    }

    public static function getOwnAuctions($type = 'all', $status = 'all', $immofilter = 'false') {
        //$auction = new Auction();
        $ret = array('running' => array(), 'ended' => array(), 'canceld' => array());

        if(Auth::guard('account')->user()->company->hasRole('admin')){
            $ownQuery = Auction::query();
        } else {
            $company_id = (Auth::guard('account')->user()->company_id);
            $ownQuery = Auction::query()->where('company_id', '=', $company_id);
        }

        if($type != 'all') {
            $ownQuery->where('marketType', '=', $type);
        }

        if($status != 'all') {
            $ownQuery->where('auctionState', '=', $status);
        }

        if($immofilter == 'true') {
            $ownQuery->where('is24estateID', '!=', '');
            $ownQuery->where('is24state', '!=', 'removed');
        }

        if($status == 'running' || $status == 'new') {
            $ownQuery->orderBy('id', 'desc');
        }

        if($status == 'ended') {
            $ownQuery->orderBy('biddingEnd', 'desc');
        }

        $own = $ownQuery->paginate(config('constants.per_page'));
        return $own;
    }

    public static function getOwnbyName($objName) {

        if(Auth::guard('account')->user()->company->hasRole('admin')){
            $ownQuery = Auction::query();
        } else {
            $company_id = (Auth::guard('account')->user()->company_id);
            $ownQuery = Auction::query()->where('company_id', '=', $company_id);
        }
        $ownQuery->where('name', 'like', $objName. "%");
        $own = $ownQuery->paginate(config('constants.per_page'));

        return $own;
    }

    public static function getOwnBiddings($type = 'all', $status = 'all') {
        $own_bidQuery = Bidding::select(\DB::raw('distinct(auctionID) as auctionID'))
            ->Join('auctions', 'biddings.auctionID', '=', 'auctions.id')->where('userID', '=', Auth::id());

        if($type != 'all') {
            $own_bidQuery->where('marketType', '=', $type);
        }

        if($status != 'all') {
            $own_bidQuery->where('auctionState', '=', $status);
        }

        $own_bid = $own_bidQuery->get();

        $auction_ids = array();
        foreach ($own_bid->all() as $own) {
            $auction_ids[] = $own->auctionID;
        }
        $own = auction::whereIn('id', $auction_ids)->paginate(config('constants.per_page'));
        return $own;
    }

    public static function getBiddingbyName($objName) {

        $own_bidQuery = Bidding::select(\DB::raw('distinct(auctionID) as auctionID'))
            ->Join('auctions', 'biddings.auctionID', '=', 'auctions.id')->where('userID', '=', Auth::id());

        $own_bidQuery->where('name', 'like', $objName. "%");
        $bid_auctionId = $own_bidQuery->value('auctionID');

        $own_bid = auction::where('id', $bid_auctionId)->paginate(config('constants.per_page'));

        return $own_bid;
    }

    public static function checkAuctionEnd() {

        $auctions = Auction::query()->where('biddingEnd', '<', date('Y-m-d H:i:s'))
            ->where('auctionState', '=', 'running')
            ->where(function ($q) {
                $q->where('marketType', 'sale')->orWhere('marketType', 'build_lease');
            })->get();

        echo date('Y-m-d H:i:s') . "\n";
        foreach ($auctions->all() as $auction) {

            if ($auction->marketType == 'build_lease') {
                if ($auction->marketForm == 'fixed_price') {
                    continue;
                }
            }

            $owners = Account::query()->where('company_id', '=', $auction->company_id)->get();
            $all_bidders = Bidding::where('auctionID', '=', $auction->id)->groupBy('userID')->get();
            $leader = Bidding::query()->where('auctionID', '=', $auction->id)
                ->join('users', 'users.id', '=', 'biddings.userID')
                ->orderBy('amount', 'desc')->get()->first();
            if (empty($all_bidders)) {
                //  $ended->where('id', '=', $auction->id)->update(['state' => "endedEmpty"]);
            }

            if ($leader && $leader->amount >= $auction->minPrice) {
                foreach ($owners as $owner) {
                    $owner->notify(new AuctionEnded($owner, $auction, $leader));
                }
            } else {
                foreach ($owners as $owner) {
                    $owner->notify(new AuctionEndedEmpty($owner, $auction));
                }
            }

            //Bieter informieren
            foreach ($all_bidders as $bidderBid) {
                $bidder = User::find($bidderBid->userID);
                if ($bidder->id == $leader->userID && $leader->amount >= $auction->minPrice) {
                    $bidder->notify(new AuctionWon($bidder, $auction));
                } else {
                    $bidder->notify(new AuctionLost($bidder, $auction));
                }
            }

            $auction->auctionState = "ended";
            if (!empty($auction->is24estateID)) {
                $auction->is24state = "remove";
                $auction->save();
                Bus::dispatch(new Is24());
            } else {
                $auction->save();
            }
        }
    }

    static function evalRatingAnswer($matrix, $answers) {
        $i = 0;
        $success = true;
        foreach (json_decode($matrix, true) as $question) {
            if ($question['correctAnswer'] === $answers[$i]) {

            } else {
                $success = false;
            }
            $i++;
        }
        return $success;
    }
}
