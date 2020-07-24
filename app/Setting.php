<?php
namespace  App;
use DB;
class Setting
{
    public static function set_setting($option_name,$option_value)
    {
        $row=DB::collection('setting')->where('option_name',$option_name)->first();
        if($row)
        {
            DB::collection('setting')->where('option_name',$option_name)
                ->update([
                    'option_value'=>$option_value
                ]);
        }
        else
        {
            DB::collection('setting')
                ->insert([
                    'option_name'=>$option_name,
                    'option_value'=>$option_value
                ]);
        }
    }
    public static function get_setting_value($option_name)
    {
        $row=DB::collection('setting')->where('option_name',$option_name)->first();
        if($row)
        {
            return $row['option_value'];
        }
        else
        {
            return '';
        }
    }
}