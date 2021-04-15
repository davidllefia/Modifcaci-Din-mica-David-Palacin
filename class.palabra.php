<?php

class Palabra extends DataBoundObject {
        protected $id;
        protected $palabra;
        protected $total;
        protected $lastvisit;

        protected function DefineTableName() {
                return("palabra");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "id",
                        "palabra" => "palabra",
                        "total" => "total",
                        "lastvisit" => "lastvisit"));
        }

}


?>