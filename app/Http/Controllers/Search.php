<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Model\Product;
    use App\Model\Session;
    use App\Model\Category;
    use App\Model\Gondola;
    use App\User;

    class Search extends Controller{

        public $model;  

        public static function quest($description, $create, $update, $typeSearch){
            global $model;
            self::searchDescription($description, $typeSearch);
            self::searchCreate($create, $typeSearch);
            self::searchUpdate($update, $typeSearch);
            
            if(!is_null($model))
                return $model;
        }

        public static function searchDescription($description, $typeSearch){
            global $model;
            if(!is_null($description))
                if($typeSearch == 'App\User')
                    $model = $typeSearch::where('name', 'like', "%".$description."%");
                                        //->where('name', 'like', "%".lcfirst($description)."%");
                else
                    $model = $typeSearch::where('description', 'like', "%".$description."%");
                                        //->orwhere('description', 'like', "%".lcfirst($description)."%");

        }

        public static function searchCreate($create, $typeSearch){
            global $model;
            if(!is_null($create)){
                $created_at = explode(' - ', $create);
                $created_at[0] = date_format(date_create($created_at[0]), 'Y-m-d');
                $created_at[1] = date_format(date_create($created_at[1]), 'Y-m-d');

                if(isset($model))
                    $model->whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
                else
                    $model = $typeSearch::whereDate('created_at','>=', $created_at[0])->whereDate('created_at','<=', $created_at[1]);
            }
        }

        public static function searchUpdate($update, $typeSearch){
            global $model;
            if(!is_null($update)){
                $updated_at = explode(' - ', $update);
                $updated_at[0] = date_format(date_create($updated_at[0]), 'Y-m-d');
                $updated_at[1] = date_format(date_create($updated_at[1]), 'Y-m-d');

                if(!is_null($model))
                    $model->whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);
                else
                    $model = $typeSearch::whereDate('updated_at','>=', $updated_at[0])->whereDate('updated_at','<=', $updated_at[1]);   
            }
        }       
    }