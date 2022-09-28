<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Models\Relation;
use App\Models\FamilyTree;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class FamilyTreeController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display the blogs page of the site
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = auth()->user();
        $family_trees = FamilyTree::where('user_id', $user->id)->orderBy('relation_id', 'ASC')->get();
        $paternal_grand_parents = [];
        $paternal_grand_parents_in_laws = [];
        $maternal_grand_parents = [];
        $maternal_grand_parents_in_laws = [];
        $father = NULL;
        $mother = NULL;
        $father_in_laws = NULL;
        $mother_in_laws = NULL;
        $wife = NULL;
        $self = NULL;
        $friends = [];
        $siblings = [];
        $siblings_in_laws = [];
        $sons = [];
        $single_sons = [];
        $daughters = [];
        $single_daughters = [];
         
        foreach($family_trees as $family_tree) {
            if($family_tree->relation_id == 1) {
                $paternal_grand_parents[] = $family_tree;
            } elseif($family_tree->relation_id == 2) {
                $paternal_grand_parents[] = $family_tree;
            } elseif($family_tree->relation_id == 3) {
                $maternal_grand_parents[] = $family_tree;
            } elseif($family_tree->relation_id == 4) {
                $maternal_grand_parents[] = $family_tree;
            } elseif($family_tree->relation_id == 5) {
                $paternal_grand_parents_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 6) {
                $paternal_grand_parents_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 7) {
                $maternal_grand_parents_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 8) {
                $maternal_grand_parents_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 9) {
                $father = $family_tree;
            } elseif($family_tree->relation_id == 11) {
                $mother = $family_tree;
            } elseif($family_tree->relation_id == 10) {
                $father_in_laws = $family_tree;
            } elseif($family_tree->relation_id == 12) {
                $mother_in_laws = $family_tree;
            } elseif($family_tree->relation_id == 13) {
                $self = $family_tree;
            } elseif($family_tree->relation_id == 14) {
                $wife = $family_tree;
            } elseif($family_tree->relation_id == 15) {
                $siblings[] = $family_tree;
            } elseif($family_tree->relation_id == 17) {
                $siblings[] = $family_tree;
            } elseif($family_tree->relation_id == 16) {
                $siblings_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 18) {
                $siblings_in_laws[] = $family_tree;
            } elseif($family_tree->relation_id == 19) {
                $spouse = $family_tree->spouse;
                if($spouse) {
                    $sons[$family_tree->id][] = $family_tree;
                    $sons[$family_tree->id][] = $spouse;
                } else {
                    $single_sons[] = $family_tree;
                }
            } elseif($family_tree->relation_id == 20) {
                //$sons[] = $family_tree;
            } elseif($family_tree->relation_id == 21) {
                $spouse = $family_tree->spouse;
                if($spouse) {
                    $daughters[$family_tree->id][] = $family_tree;
                    $daughters[$family_tree->id][] = $spouse;
                } else {
                    $single_daughters[] = $family_tree;
                }
            } elseif($family_tree->relation_id == 22) {
                //$daughters[] = $family_tree;
            } elseif($family_tree->relation_id == 24) {
                //$grand_childrens[] = $family_tree;
            } elseif($family_tree->relation_id == 25) {
                //$grand_childrens[] = $family_tree;
            } else {
                $friends[] = $family_tree;
            }
        }
        
        $relations = Config::get('constants.RELATIONS');

        if(count($family_trees) == 1) {
            foreach($relations as $key=>$relation) {
                if(in_array($key, [9, 11, 14])) {

                } else {
                    unset($relations[$key]);
                }
            }
        }

        if(!$family_trees->where('relation_id', 14)->first()) {
            unset($relations[5]);
            unset($relations[6]);
            unset($relations[7]);
            unset($relations[8]);
            unset($relations[10]);
            unset($relations[12]);
            unset($relations[16]);
            unset($relations[18]);
        } else {
            unset($relations[14]);
        }

        $removedes = FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14])->get();

        foreach ($removedes as $removed) {
            unset($relations[$removed->relation_id]);
        }

        $removedes = FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14])->get();

        foreach ($removedes as $removed) {
            unset($relations[$removed->relation_id]);
        }

        if(!FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [19, 21])->count()) {
            unset($relations[20]);
            unset($relations[22]);
            unset($relations[24]);
            unset($relations[25]);
        }

        if(!FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [10, 12])->count()) {
            unset($relations[16]);
            unset($relations[18]);
        }

        if(!FamilyTree::where('user_id', $user->id)->where('relation_id', 10)->count()) {
            unset($relations[5]);
            unset($relations[6]);
        }

        if(!FamilyTree::where('user_id', $user->id)->where('relation_id', 12)->count()) {
            unset($relations[7]);
            unset($relations[8]);
        }

        if(!FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [9, 11])->count()) {
            unset($relations[15]);
            unset($relations[17]);
        }

        if(!FamilyTree::where('user_id', $user->id)->where('relation_id', 9)->count()) {
            unset($relations[1]);
            unset($relations[2]);
        }

        if(!FamilyTree::where('user_id', $user->id)->where('relation_id', 11)->count()) {
            unset($relations[3]);
            unset($relations[4]);
        }

        $sons_relations = FamilyTree::where('user_id', $user->id)->where('relation_id', 19)->get();

        $daughter_relations = FamilyTree::where('user_id', $user->id)->where('relation_id', 21)->get();
        $children_relations = FamilyTree::where('user_id', $user->id)->whereIn('relation_id', [19, 21])->get();
        
        return view('frontend.family-trees.index', compact('family_trees', 'paternal_grand_parents', 'paternal_grand_parents_in_laws', 'maternal_grand_parents', 'maternal_grand_parents_in_laws', 'father', 'father_in_laws', 'mother', 'mother_in_laws', 'self', 'wife', 'friends', 'siblings', 'siblings_in_laws', 'sons', 'daughters', 'relations', 'daughter_relations', 'sons_relations', 'single_sons', 'single_daughters', 'children_relations'));
    }
    
    /**
     * Handle a registration request for the application and sent mail to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'relation_first_name' => 'required|string|max:255',
            'relation_last_name' => 'required|string|max:255',
            'relation_id'     => 'required',
            'connect_with'  => 'required',
            'relation_dob'  => 'required',
            'gender' => 'required',
        ];

        $messages = [
//            'title.required' => 'Title is required',
        ];

        $this->validate($request, $rules, $messages);
        
        $input = [];
        $input['first_name'] = $request->get('relation_first_name');
        $input['last_name'] = $request->get('relation_last_name');
        $input['relation_id'] = $request->get('relation_id');
        $input['dob'] = date_format(date_create( $request->relation_dob),'Y-m-d'); //Carbon::createFromFormat('m-d-Y', $request->get('relation_dob'))->format('Y-m-d');
        $input['connect_with'] = $request->get('connect_with');
        $input['gender'] = $request->get('gender');

        if($request->get('relation_id') == 20) {
            $input['spouse_id'] = $request->get('son_id');
            $tree = FamilyTree::find($request->get('son_id'));
        }

        if($request->get('relation_id') == 22) {
            $input['spouse_id'] = $request->get('daughter_id');
            $tree = FamilyTree::find($request->get('daughter_id'));
        }

        if($request->get('relation_id') == 24 || $request->get('relation_id') == 25) {
            $input['parent_id'] = $request->get('parent_id');
        }

        $input['user_id'] = auth()->user()->id;
        $family_trees = FamilyTree::create($input);

        if($request->get('relation_id') == 20 || $request->get('relation_id') == 22) {
            $tree->update([
                'spouse_id' => $family_trees->id
            ]);
        }

        return response()->json(
            [
                'status'       => 'success',
                'family_trees' => $family_trees,
            ]
        );
    }
}
