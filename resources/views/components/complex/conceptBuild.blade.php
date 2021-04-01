@if(!$readonly)
    <p>@lang('messages.conceptMatrixOwnText')</p>
@endif
<p>@lang('messages.conceptMatrixSetupText')</p>
<div id="{{$slot}}" class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
    <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
        <div class="flex flex-wrap ">
            <div class="w-3/4"><h4> @lang('messages.categoryWithcCriteria')</h4></div>
            <div class="w-1/4"><h4> @lang('messages.rating')</h4></div>
        </div>
    </div>
    <div class="flex-auto p-6 no-border-top">
        @if(count($value))
            <div class="error-message mb-1">@lang('messages.100PercentCatNeeded')</div>
            <div class="dataHolder" id="dataHolder_{{$slot}}">
                @foreach($value as $key=>$category)
                    @component('components.complex.conceptCategoryContainer',["groupID"=>$key,"name"=>$category['name'], "id_cat" => $key, "value"=>$category['value'],"readonly"=>$readonly])
                        @foreach($category['criteria'] as $ckey=>$criteria)
                            @component('components.complex.conceptItem',["name"=>$criteria['name'],"id_cat" => $key,"id_crit" => $ckey,"value"=>$criteria['value'],"readonly"=>$readonly]) {{$criteria['name']}}  @endcomponent
                        @endforeach
                    @endcomponent
                @endforeach
            </div>
            <div class="flex flex-wrap  mt-3">
                <div class="w-3/4">
                    <label class="perc_text" id="cccs_total_text">@lang('messages.100PercentCatNeeded')</label>
                </div>
                <div class="w-1/4">
                    <h3><label class="perc_value text-right" id="cccs_total_value"></label></h3>
                </div>
            </div>
        @else
            <div class="error-message mb-1">@lang('messages.noCriteria')</div>
        @endif
    </div>
</div>

<div class="flex flex-wrap  mt-3">
    <div class="relative flex-grow max-w-full flex-1 px-4 text-right">
        @if(!$readonly)
            <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default cbAddButton_{{$slot}}">@lang('messages.addCategory')</button>
        @endif
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default cbOkButton-save" id="cbOkButton_{{$slot}}" data-holder="dataHolder_{{$slot}}" data-id="{{$slot}}" data-dismiss="modal">@lang('messages.saveCriteriaCatalog')</button>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        var add_item = 1;
        var cat_sum = 0;
        var formOK = true;
        var conceptData = null;
        var divDataholder = "#dataHolder_conceptMatrix_standard";

        $(document).ready(function () {
            $('.error-message').hide();
            $('#cbOkButton_{{$slot}}').click(function (e) {
                displayConceptData();
                $('#ratingMarket-div .fv-help-block').hide();
                $('#conceptMatrix_form').val(JSON.stringify(conceptData));
                $('.set-concept').hide();
            });
            $('.cbAddButton_{{$slot}}').click(function () {
                enableButtons_{{$slot}}();
                displayConceptData();
            });

            displayConceptData();
            enableButtons_{{$slot}}();
        });

        $('#cd_own_conceptMatrix').on('show.bs.modal', function () {
            divDataholder = "#dataHolder_conceptMatrix_own";
            displayConceptData();
            enableButtons_{{$slot}}();
        })

        $('#cd_standard_conceptMatrix').on('show.bs.modal', function () {
            divDataholder = "#dataHolder_conceptMatrix_standard";
            displayConceptData();
            enableButtons_{{$slot}}();
        })

        /* save temporar to hidden form-field */
        $('#cbOkButton_{{$slot}}').click(function (e) {
            displayConceptData();
            $('#conceptMatrix_form').val(JSON.stringify(conceptData));
        });

        function displayConceptData(slot_cd) {
            formOK = true;
            cat_sum = 0;
            conceptData = null;
            conceptData = null;
            evalCategories(slot_cd);
        }

        function evalCategories(slot_cd) {
            var data = Array();

            $(divDataholder).find('.cat-group').each(function (a, b) {
                group_id = $(b).attr('id');
                cat_name = $(b).children().find('>.cat-label>input').val();
                cat_value = $(b).children().find('>.cat-val>.input-group>input').val();

                if (cat_value) {
                    cat_sum = +cat_sum + +cat_value;
                }
                crit_data = evalCriterias(group_id);

                if (crit_data == false) {
                   formOK = false;
                } else {
                    data.push({name: cat_name, value: cat_value, criteria: crit_data});
                }
            });


            conceptData = data;

           // console.log(cat_name, cat_value, crit_data);
            $('#cccs_total_value').text(cat_sum + " %");

            if (cat_sum != 100) {
                $('#cccs_total_value, #cccs_total_text').removeClass('success danger').addClass('danger');
                $('.cat-item input[type="number"]').removeClass('success danger').addClass('danger');
                $('.error-message').show().removeClass('success danger').addClass('danger');
                $('.cat-item .category-txt').addClass('is-invalid');
            } else {
                $('#cccs_total_value, #cccs_total_text').removeClass('success danger').addClass('success');
                $('.cat-item input[type="number"]').removeClass('success danger').addClass('success');
                $('.cat-item .category-txt').removeClass('is-invalid');
                $('.error-message').hide();
            }
            if (cat_sum == 100 && formOK) {
                $('.cbOkButton-save').prop('disabled', false);
            } else {
                $('.cbOkButton-save').prop('disabled', true);
            }
        }

        function evalCriterias(group_id) {

            var id_cat = group_id.substr(group_id.length - 1);
            //console.log(id_cat);

            var crit_sum = 0;
            var catLabel = $(divDataholder+' #'+group_id).children().find('.category-txt');
            var list = $(divDataholder+' #'+group_id).children().next().find('.crit-item');
            var list_percent = $(divDataholder+' #'+group_id).children().next().next().find('.perc_value');
            var status_txt = $(divDataholder+' #'+group_id).children().next().next().find('.perc_text');
            var label_text = $(divDataholder+' #'+group_id).children().next().next().next('.label_text');

            var data = Array();

            $(list).each(function (a, b) {
                crit_name = $(b).find('>.item-label>input').val();
                crit_value = $(b).find('>.item-val>.input-group>input').val();
                id_crit_name =  $(b).prop("id");
                id_group_cit = id_crit_name.substring(5,6);

                if(id_cat == id_group_cit) {
                    if(crit_value) {
                        crit_sum = +crit_sum + +crit_value;
                        data.push({name: crit_name, value: crit_value});
                    }
                }
            });

            $(list_percent).text(crit_sum + " %");

            $(label_text).css("display", "none");
            if (crit_sum != 100) {
                $(status_txt).removeClass('success danger').addClass('danger');
                $(list_percent).removeClass('success danger').addClass('danger');
                $(catLabel).removeClass('success danger').addClass('danger');
                return false;
            } else {
                $(status_txt).removeClass('success danger').addClass('success');
                $(list_percent).removeClass('success danger').addClass('success');
                $(catLabel).removeClass('success danger').addClass('success');
                if(crit_name == '' || crit_value == '') {
                    $(catLabel).removeClass('success danger').addClass('danger');
                    $(label_text).css("display", "block");
                    return false;
                } else {
                    $(catLabel).removeClass('success danger').addClass('success');
                    $(label_text).css("display", "none");
                }
                if (data && data.length > 0) {
                    return(data);
                }
            }

        }

        function addConceptCriteria(where, cat_id) {
            var $last_div = $(where).parent().parent().parent().parent().parent().find('#crits_'+cat_id).first().find('.crit-item').last();
            var id_name = $last_div.prop("id");
            var id_crid_name = id_name.substr(0,7);
            var id_crid = id_name.substr(id_name.length - 1);
            id_crid = parseInt(id_crid) + 1;
            var clone_last = $last_div.clone().prop('id', 'crit_'+cat_id+'_'+id_crid );
            clone_last.find('.procent-label').val("@lang('messages.newCriteria')");
            clone_last.find('.procent_val').val(5);
            clone_last.find('input').attr('placeholder', '');
            // console.log(clone_last);
            $($last_div).after(clone_last);
            displayConceptData();
        }

        function deleteCriteria(where) {
            var closest_row = $(where).closest('.row');
            var row_id_name = closest_row.attr('id');
            var crit_id = row_id_name.substr(row_id_name.length - 1);
            if(crit_id > 0) {
                $(where).closest('.row').remove();
            }
        }

        function deleteCategory(where, group_id) {
            count_groups = $(divDataholder+' .cat-group').length;
            if(count_groups > 1) {
                $('#group_'+group_id).remove();
            }
        }

        function addConceptCategory(divDataholder) {
            //console.log(divDataholder);
            var last_cat_div = $(divDataholder).find('.cat-group:visible').last();
            var id_name = last_cat_div.prop("id");
            var id_cat_name = id_name.substr(0,4);
            var id_cat = id_name.substr(id_name.length - 1);
            id_cat = parseInt(id_cat) + 1;

            var clone_last_cat = last_cat_div.clone().prop('id', 'group_'+id_cat);
            clone_last_cat.find('.cat-item').attr('id', 'cat_'+id_cat);
            clone_last_cat.find('.crits').attr('id', 'crits_'+id_cat);
            clone_last_cat.find('input').attr('placeholder', '');
            clone_last_cat.find('input').val("@lang('messages.newCategory')");
            clone_last_cat.find('.catprocent').val(10);
            clone_last_cat.find('.cCategoryDeleteButton').attr('id', id_cat)
            clone_last_cat.find('.cbAddCriteriaButton').attr('id', id_cat)

            clone_last_cat.find('.crit-item').each(function (key, val) {
                if(key > 0) {
                    val.remove();
                } else {
                    $(this).attr('id',   'crit_'+id_cat+'_0');
                    $(this).find('input').val("@lang('messages.newCriteria')");
                    $(this).find('.procent_val').attr('id', "procent_"+id_cat+"_0");
                    $(this).find('.procent_val').val(100);
                    // console.log(this.id);
                }
            })
            $(last_cat_div).append(clone_last_cat);
        }

        function enableButtons_{{$slot}}() {
            $(divDataholder+' div>input').change(function () {
                displayConceptData();
            })
            $(divDataholder+' div>input[type=number]').keypress(function (e) {
                var val = 20;
                if (e.which == 13) {
                    if( !$(this).val() ) {
                        this.value = val;
                    }
                    displayConceptData();
                    //e.preventDefault();
                }
            })

            $(divDataholder+' div>input[type=text]').keypress( function(e) {
                if (e.which == 13) {
                    displayConceptData('#cbOkButton_{{$slot}}');
                    e.preventDefault();
                }
            })

            $('.cbDeleteButton').off().click(function () {
                $(this).parents('.quItem').remove();
            });
            $('.cCriteriaDeleteButton').off().click(function (e) {
                deleteCriteria(this);
                displayConceptData();
            });
            $('.cCategoryDeleteButton').off().click(function (e) {
                deleteCategory(this, this.id);
                displayConceptData();
            });

            $('.cbAddButton_{{$slot}}').off().click(function () {
                addConceptCategory(divDataholder);
                enableButtons_{{$slot}}();
                displayConceptData();
            });

            $('.cbAddCriteriaButton').off().click(function (e) {
                addConceptCriteria(e.target, this.id);
                enableButtons_{{$slot}}();
            });
        }
    </script>
@endpush()