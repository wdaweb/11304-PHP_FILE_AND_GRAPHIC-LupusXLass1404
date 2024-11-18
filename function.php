<?php

define("DBNAME","file");


/***
    * 建立資料庫的連線變數
    * @param string $db 資料表名稱
    * @return object
    */ 
    function db($db){
        $dsn="mysql:host=localhost;charset=utf8;dbname=$db";
        return NEW PDO($dsn, 'root', '');
    }

    /***
    * 回傳指定資料表所有資料
    * @param string $table 資料表名稱
    * @return array
    */ 
    function all($table){
        $sql= "select * from $table";
        $rows= db(DBNAME) -> query($sql) -> fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
    * 回傳指定資料表的特定ID的單筆資料  
    * @param string $table 資料表名稱
    * @param integer $id || array $id 資料表ID
    * @reture array
    */
    function find($table, $id){
        if(is_array($id)){
            $tmp=[];
            foreach($id as $key => $value){
                // $tmp[]=sprintf("`%s`= '%s', $key, $value");
                $tmp[]="`$key`='$value'";
            }
            $sql= "select * from $table where".join("&&", $tmp);
        } else {
            $sql = "select * from $table where `id`='$id'";
        }
        $rows = db(DBNAME) -> query($sql) ->fetchAll(PDO::FETCH_ASSOC);
        return $rows; 
    }

    /**
     * 
     * @reture boolean
     */
    function del($table, $id){
        $sql = "delete from $table where id='$id'";
        $ex = db(DBNAME) -> exec($sql);
        echo $ex;
    }

    /**
     * @param string $table 資料表名稱
     * @param array $array 更新欄位及內容
     * @param array || number $id 條件（數字或陣列）
     * @return boolean
     */

     function update($table, $array, $id){
        $sql= "update $table set ";
        
        if(is_array($id)){
            $tmp= [];
            foreach($array as $key => $value){
                $tmp[] = "`$key`='$value'";
            }
            $sql=$sql . join(",",$tmp);
    
        }else{
            $sql=$sql . " where `id`='$id'";
        }
    
        return db(DBNAME) -> exec($sql);
    }

    /**
     * 新增資料
     * @param string $table 資料表名稱
     * @param string
     * @param string
     * @return boolean
     */

     function insert($table, $array){
        $sql="insert into $table ";
        $keys=array_keys($array);
        
        $sql=$sql . "(`".join("`,`",$keys)."`) values ('".join("','",$array)."')";
        return db(DBNAME) -> exec($sql);
     }


    /**
     * 列出陣列內容
     */
    function dd($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    //insert("member",["acc"=>21,
    //                 "pw"=>21,
    //                 "email"=>"21@gmail.com",
    //                 "tel"=>"0933254879"]);
    //
    //update('member',['email'=>'19@gmail.com'],['acc'=>'19','pw'=>'19']);
?>