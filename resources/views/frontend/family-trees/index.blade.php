@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Family Tree</title>
@endsection

@section('content')

<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Family Tree</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="familyTree_list_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="blog_filter_section">
                        <div class="blog_tittle_left">Family Tree Of {{ $authuser->full_name }} Family</div>
                        <div class="filter_select fm_ad">
                            <a href="#" data-toggle="modal" data-target="#new_member_pp">Add Member</a>
                        </div><!--filter_select-->
                    </div><!--blog_filter_section-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="family_tree_wrapper">
                        <div class="fm_tree_wrapper_inner">
                            <div class="fm_tree_parent_row @if(count($paternal_grand_parents) || count($maternal_grand_parents)) @if(count($sons) || count($daughters) || count($single_sons) || count($single_daughters)) common_couple_bg @endif @else @if(count($sons) || count($daughters) || count($single_sons) || count($single_daughters)) common_couple_bg2 @endif @endif">
                                <div class="family_tree_center @if(count($paternal_grand_parents) && count($maternal_grand_parents)) @elseif($father && $mother) fm_custom_tree @elseif($father || $mother) fm_custom_tree2 @endif">
                                    <div class="family-tree-single-row @if(count($paternal_grand_parents) && count($maternal_grand_parents)) common_couple_bg @endif">
                                        @if(count($paternal_grand_parents) || $father || $mother)
                                        @if(count($paternal_grand_parents))
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col @if(count($paternal_grand_parents) > 1) common_couple_bg @endif">
                                                @foreach($paternal_grand_parents as $family_tree)
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($paternal_grand_parents) > 1) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @endforeach
                                            </div><!--ft_parents_col-->
                                            @if($father)
                                            <div class="ft_child_row">
                                                <div class="child_col_single single_child_right_align">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($mother) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $father->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $father->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($father->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--child_col_1-->
                                            </div><!--ft_child_row-->
                                        @endif
                                        </div><!--family_tree_parent_s-->
                                        @elseif($father || $mother)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col @if($mother && $mother) common_couple_bg @endif">
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single photo_border_right">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $father->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $father->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($father->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @if($mother)
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single photo_border_left">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $mother->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $mother->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($mother->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @else

                                                @endif
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endif
                                        @endif
                                        @if(count($maternal_grand_parents))
                                        <div class="family_tree_parent_s">
                                            @if(count($maternal_grand_parents))
                                            <div class="ft_parents_col @if(count($maternal_grand_parents) > 1) common_couple_bg @endif">
                                                @foreach($maternal_grand_parents as $family_tree)
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($maternal_grand_parents) > 1) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @endforeach
                                            </div><!--ft_parents_col-->
                                            @endif 

                                            @if($mother)
                                            <div class="ft_child_row">
                                                <div class="child_col_single single_child_left_align">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($father) photo_border_left @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $mother->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $mother->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($mother->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--child_col_1-->
                                            </div><!--ft_child_row-->
                                            @endif
                                        </div><!--family_tree_parent_s-->
                                        @endif
                                    </div><!--family-tree-single-row-->
                                    @if(count($siblings) || $self)
                                    <div class="family-tree-children-row">
                                        @foreach($siblings as $family_tree)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col">
                                                <div class="parent_col_1 {{ $family_tree->genderLabel }} center_border_top">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endforeach

                                        @if($self)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col">
                                                <div class="parent_col_1 active_member @if(count($paternal_grand_parents) || count($maternal_grand_parents)) center_border_top @endif">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($wife) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $self->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $self->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($self->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endif
                                    </div><!--family-tree-single-row-->
                                    @endif
                                </div><!--family_tree_center-->

                                <div class="family_tree_center @if(count($paternal_grand_parents_in_laws) && count($maternal_grand_parents_in_laws)) @elseif($father_in_laws && $mother_in_laws) fm_custom_tree @elseif($father_in_laws || $mother_in_laws) fm_custom_tree2 @endif">
                                    <div class="family-tree-single-row @if(count($paternal_grand_parents_in_laws) && count($maternal_grand_parents_in_laws)) common_couple_bg @endif">
                                        @if(count($paternal_grand_parents_in_laws) || $father_in_laws || $mother_in_laws)
                                        @if(count($paternal_grand_parents_in_laws))
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col @if(count($paternal_grand_parents_in_laws) > 1) common_couple_bg @endif">
                                                @foreach($paternal_grand_parents_in_laws as $family_tree)
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($paternal_grand_parents_in_laws) > 1) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @endforeach
                                            </div><!--ft_parents_col-->

                                            @if($father_in_laws)
                                            <div class="ft_child_row">
                                                <div class="child_col_single single_child_right_align">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($mother_in_laws) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $father_in_laws->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $father_in_laws->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($father_in_laws->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--child_col_1-->
                                            </div><!--ft_child_row-->
                                            @endif
                                        </div><!--family_tree_parent_s-->
                                        @elseif($father_in_laws || $mother_in_laws)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col @if($mother && $mother) common_couple_bg @endif">
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single photo_border_right">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $father_in_laws->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $father_in_laws->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($father_in_laws->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @if($mother_in_laws)
                                                <div class="parent_col_1">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single photo_border_left">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $mother_in_laws->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $mother_in_laws->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($mother_in_laws->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @else

                                                @endif
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endif
                                        @endif

                                        @if(count($maternal_grand_parents_in_laws))
                                        <div class="family_tree_parent_s">
                                            @if(count($maternal_grand_parents_in_laws))
                                            <div class="ft_parents_col @if(count($maternal_grand_parents_in_laws) > 1) common_couple_bg @endif">
                                                @foreach($maternal_grand_parents_in_laws as $family_tree)
                                                <div class="parent_col_1 grand_{{ $family_tree->genderLabel }}">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($maternal_grand_parents_in_laws) > 1) photo_border_right @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                                @endforeach
                                            </div><!--ft_parents_col-->
                                            @endif
                                            @if($mother_in_laws)
                                            <div class="ft_child_row">
                                                <div class="child_col_single single_child_left_align">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single @if($father_in_laws) photo_border_left @endif">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $mother_in_laws->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $mother_in_laws->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($mother_in_laws->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--child_col_1-->
                                            </div><!--ft_child_row-->
                                            @endif
                                        </div><!--family_tree_parent_s-->
                                        @endif
                                    </div><!--family-tree-single-row-->
                                    @if($wife || count($siblings_in_laws))
                                    <div class="family-tree-children-row">
                                        @if($wife)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col">
                                                <div class="parent_col_1  @if(count($paternal_grand_parents_in_laws) || count($maternal_grand_parents_in_laws)) center_border_top @endif">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single photo_border_left">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $wife->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $wife->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($wife->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endif

                                        @foreach($siblings_in_laws as $family_tree)
                                        <div class="family_tree_parent_s">
                                            <div class="ft_parents_col">
                                                <div class="parent_col_1 {{ $family_tree->genderLabel }} center_border_top">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                        </div><!--family_tree_parent_s-->
                                        @endforeach                                    
                                    </div><!--family-tree-single-row-->
                                    @endif
                                </div><!--family_tree_center-->
                            </div><!--fm_tree_parent_row-->

                            @if(count($sons) || count($daughters) || count($single_sons) || count($single_daughters))
                            <div class="fm_tree_child_row">
                                <div class="fm_shildren_row_inner">
                                    @foreach($sons as $key=>$son)
                                    <div class="ft_parents_col @if(count($sons) + count($daughters) + count($single_sons) + count($single_daughters) == 1) single-child @endif">
                                        <div class="custom_parent_row common_couple_bg">
                                            @foreach($son as $family_tree)
                                            <div class="parent_col_1 center_border_top">
                                                <div class="publish_col">
                                                    <div class="publish_col_inner">
                                                        <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($paternal_grand_parents) > 1) photo_border_right @endif">
                                                            <div class="photo_member">
                                                                <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                            </div>
                                                        </div><!--photo_col_single-->
                                                        <div class="mem_info">
                                                            <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                            <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                        </div><!--mem_info-->
                                                    </div>
                                                </div><!--publish_col-->
                                            </div><!--parent_col_1-->
                                            @endforeach
                                        </div><!--custom_parent_row-->
                                        @if($family_trees->where('parent_id', $key)->count())
                                        <div class="grand_children_row @if(count($family_trees->where('parent_id', $key)) == 1) grand_children_row_single @endif">
                                            @foreach($family_trees->where('parent_id', $key) as $family_tree)
                                            <div class="ft_parents_col @if(count($family_trees->where('parent_id', $key)) == 1) single-child @endif">
                                                <div class="parent_col_1 center_border_top ">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                            @endforeach
                                        </div><!--grand_children_row-->
                                        @endif
                                    </div><!--ft_parents_col-->

                                    @endforeach

                                    @foreach($single_sons as $family_tree)
                                    <div class="ft_parents_col @if(count($sons) + count($daughters) + count($single_sons) + count($single_daughters) == 1) single-child @endif">
                                        <div class="custom_parent_row">
                                            <div class="parent_col_1">
                                                <div class="publish_col">
                                                    <div class="publish_col_inner">
                                                        <div class="photo_col_single center_border_top">
                                                            <div class="photo_member">
                                                                <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="mem_info">
                                                            <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                            <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @foreach($daughters as $key=>$daughter)
                                    <div class="ft_parents_col @if(count($sons) + count($daughters) + count($single_sons) + count($single_daughters) == 1) single-child @endif">
                                        <div class="custom_parent_row common_couple_bg">
                                            @foreach($daughter as $family_tree)
                                            <div class="parent_col_1">
                                                <div class="publish_col">
                                                    <div class="publish_col_inner">
                                                        <div class="photo_col_single @if($loop->iteration > 1) photo_border_left @elseif(count($paternal_grand_parents) > 1) photo_border_right @endif">
                                                            <div class="photo_member">
                                                                <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                            </div>
                                                        </div><!--photo_col_single-->
                                                        <div class="mem_info">
                                                            <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                            <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                        </div><!--mem_info-->
                                                    </div>
                                                </div><!--publish_col-->
                                            </div><!--parent_col_1-->
                                            @endforeach
                                        </div><!--custom_parent_row-->
                                        @if($family_trees->where('parent_id', $key)->count())
                                        <div class="grand_children_row @if(count($family_trees->where('parent_id', $key)) == 1) grand_children_row_single @endif">
                                            @foreach($family_trees->where('parent_id', $key) as $family_tree)
                                            <div class="ft_parents_col @if(count($family_trees->where('parent_id', $key)) == 1) single-child @endif">
                                                <div class="parent_col_1 grand_{{ $family_tree->genderLabel }} center_border_top">
                                                    <div class="publish_col">
                                                        <div class="publish_col_inner">
                                                            <div class="photo_col_single">
                                                                <div class="photo_member">
                                                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                                </div>
                                                            </div><!--photo_col_single-->
                                                            <div class="mem_info">
                                                                <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                                <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                            </div><!--mem_info-->
                                                        </div>
                                                    </div><!--publish_col-->
                                                </div><!--parent_col_1-->
                                            </div><!--ft_parents_col-->
                                            @endforeach
                                        </div><!--grand_children_row-->
                                        @endif
                                    </div><!--ft_parents_col-->
                                    @endforeach

                                    @foreach($single_daughters as $family_tree)
                                    <div class="ft_parents_col @if(count($sons) + count($daughters) + count($single_sons) + count($single_daughters) == 1) single-child @endif">
                                        <div class="custom_parent_row">
                                            <div class="parent_col_1">
                                                <div class="publish_col">
                                                    <div class="publish_col_inner">
                                                        <div class="photo_col_single center_border_top">
                                                            <div class="photo_member">
                                                                <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="mem_info">
                                                            <div class="mem_name"><a href="#">{{ $family_tree->full_name }}</a></div>
                                                            <div class="mem_oth">{!! Helper::activeConnectedRelationLabel($family_tree->relation_id) !!}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div><!--fm_shildren_row_inner-->
                            </div><!--fm_tree_child_row-->
                            @endif
                        </div><!--family_tree_wrapper-->
                    </div><!--family_tree_wrapper-->
                </div>
            </div>
            @if(count($friends))
            <div class="row">
                <div class="col-xs-12">
                    <div class="center_tittle"><h2>Friends</h2></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="friend_col_center">
                        @foreach($friends as $family_tree)
                        <div class="single_friend_col">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt="" /></a>
                                </div>
                                <div class="media-body">
                                    <h3><a href="#">{{ $family_tree->full_name }}<span><img src="{{ URL::to('/') }}/images/frontend/photo_{{ $family_tree->gender }}.png" alt="" /></span></a></h3>
                                </div>
                            </div>
                        </div><!--single_friend_col-->
                        @endforeach
                    </div><!--friend_col_center-->
                </div>
            </div>
            @endif
        </div>
    </div><!--familyTree_list_section-->
</div><!--content-->


<div class="modal fade modal-vcenter member_plus" id="new_member_pp" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal_tittle">
                            <h2>Add people to your family tree and friens connections</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal-block">
                            <div class="modal-form">
                                {!! Form::open(['method'=>'POST', 'action'=>'frontend\FamilyTreeController@store', 'onsubmit'=>'return checkRelationValid()', 'id' => 'relationForm']) !!}
                                <div class="form-group">
                                    <div class="form_select_common select_common">
                                        <select class="option-select" name="aa" onchange="setMemberInfo(this.value)">
                                            <option  value="">Choose Member From Existing User</option>
                                        @php($userList=App\Models\User::orderBy('id','asc')->get())
                                            @foreach($userList as $key=>$userInfo)
                                                <option  value="{{$userInfo}}" >{{$userInfo->first_name.' '.$userInfo->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    {!! Form::text('relation_first_name', null, ['class'=>'form-control', 'placeholder' => 'First Name','id'=>'first_name']) !!}
                                </div><!--form-group-->

                                <div class="form-group">
                                    {!! Form::text('relation_last_name', null, ['class'=>'form-control', 'placeholder' => 'Last Name','id'=>'last_name']) !!} 
                                </div><!--form-group-->

                                <div class="form-group">
                                    <div class="form_select_common select_common">
                                        {!! Form::select('relation_id', [''=>'Choose a Relation']+$relations, null, ['class'=>'option-select', 'id'=>'relation_id']) !!}
                                    </div>
                                </div><!--form-group-->
                                
                                <div class="form-group hidden son_id">
                                    <div class="form_select_common select_common">
                                        {!! Form::select('son_id', [''=>'Choose Spouse']+$sons_relations->pluck('full_name', 'id')->all(), null, ['class'=>'option-select', 'id'=>'son_id']) !!}
                                    </div>
                                </div><!--form-group-->
                                
                                <div class="form-group hidden daughter_id">
                                    <div class="form_select_common select_common">
                                        {!! Form::select('daughter_id', [''=>'Choose Spouse']+$daughter_relations->pluck('full_name', 'id')->all(), null, ['class'=>'option-select', 'id'=>'daughter_id']) !!}
                                    </div>
                                </div><!--form-group-->
                                
                                <div class="form-group hidden parent_id">
                                    <div class="form_select_common select_common">
                                        {!! Form::select('parent_id', [''=>'Choose Spouse']+$children_relations->pluck('parent_full_name', 'id')->all(), null, ['class'=>'option-select', 'id'=>'parent_id']) !!}
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    {!! Form::text('relation_dob', null, ['class'=>'form-control dob_input', 'id' => 'relation_dob', 'placeholder' => 'Date Of Birth (MM/DD/YYYY)', 'autocomplete' => 'off']) !!}
                                </div><!--form-group-->

                                <div class="form-group">
                                    <div class="form_select_common select_common">
                                        {!! Form::select('connect_with', [''=>'Choose a Connect With']+Config::get('constants.CONNECT_WITH'), null, ['class'=>'option-select', 'id'=>'connect_with']) !!}
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    <div class="label_tittle">Gender :</div>
                                    <div class="gn_block">
                                        <div class="rd_check radio_check2">
                                            <input name="gender" id="gd_1" value="male" type="radio" checked="">
                                            <label for="gd_1">Male</label>
                                        </div>
                                        <div class="rd_check radio_check2">
                                            <input name="gender" id="gd_2" value="female" type="radio">
                                            <label for="gd_2">Female</label>
                                        </div>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    <div class="row padding_gap_3">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="modal_confirm_btn"><button type="submit" class="btn_member">Add Member</button></div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="modal_cancel_btn"><a href="#" data-dismiss="modal" aria-label="Close">Cancel</a></div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div><!--end modal-left-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--sign up modal end -->

@endsection

@section('scripts')
<script type="text/javascript">
    $('#relation_dob').datepicker({
        autoclose: true,
        format: 'mm/dd/yyyy'
    });
    function setMemberInfo (dataInfo) {
        dataInfo=JSON.parse(dataInfo);
       var dob=new Date(dataInfo.dob);
        dob= (dob.getMonth()+1)+"/"+dob.getDate()+"/"+dob.getFullYear();
        
        $("#first_name").val(dataInfo.first_name);
        $("#last_name").val(dataInfo.last_name);
        $("#relation_dob").val(dob);
        
        if(dataInfo.gender=="Male"){
            // console.dir(dataInfo.gender);
            $("#gd_1").attr("checked","true");
            $("#gd_2").removeAttr("checked");
        }
        else{
             // console.dir(dataInfo.gender);
            $("#gd_1").removeAttr("checked");
            $("#gd_2").attr("checked","true");
         }

    }
    function checkRelationValid() {
        var form_data = new FormData($("#relationForm")[0]);
        $('.form-group span').remove();
        $.ajax({
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            url: "{{ route('family-trees.store') }}",
            success: function (response) {
                location.reload();
            },
            error: function (data) {
                if (data.status == 422) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function (i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span style="color: red;">' + error[0] + '</span>'));
                    });
                }
            }
        });
        return false;
    }

    $('#relation_id').chosen().change(function() {
        var relation_id = $('#relation_id').val();
        if(relation_id == 20) {
            $('.son_id').removeClass('hidden');
            $('.daughter_id').addClass('hidden');
            $('.parent_id').addClass('hidden');
        } else if(relation_id == 22) {
            $('.son_id').addClass('hidden');
            $('.daughter_id').removeClass('hidden');
            $('.parent_id').addClass('hidden');
        } else if(relation_id == 24) {
            $('.son_id').addClass('hidden');
            $('.daughter_id').addClass('hidden');
            $('.parent_id').removeClass('hidden');
        } else if(relation_id == 25) {
            $('.son_id').addClass('hidden');
            $('.daughter_id').addClass('hidden');
            $('.parent_id').removeClass('hidden');
        } else {
            $('.son_id').addClass('hidden');
            $('.daughter_id').addClass('hidden');
            $('.parent_id').addClass('hidden');
        }
    });
</script>
@endsection