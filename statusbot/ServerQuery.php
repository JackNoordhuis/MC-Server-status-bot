<?php

namespace statusbot;

class ServerQuery {

        public $ip;

        public $port;

        public $type;

        public $lastQuery = null;

        public function __construct($ip, $port, $type) {
                $this->ip = $ip;
                $this->port = $port;
                $this->type = ($type === "pc" ? "info" : $type);
        }
        
        public function query() {
                $queryData = json_decode(file_get_contents("https://mcapi.ca/query/" . $this->ip . ":" . $this->port . "/" . $this->type), true);
                if($this->isQuery($queryData)) {
                        $this->lastQuery = $queryData;
                        return true;
                }
                $this->lastQuery = null;
                return false;
        }
        
        public function isQuery($query) {
                return is_array($query);
        }
        
        public function isOnline() {
                if(!$this->isQuery($this->lastQuery)) return null;
                return (bool) $this->lastQuery["online"];
        }
        
        public function getOnlinePlayers() {
                if(!$this->isQuery($this->lastQuery)) return 0;
                return $this->lastQuery["players"]["online"];
        }
        
        public function getMaxPlayers() {
                if(!$this->isQuery($this->lastQuery)) return 0;
                return $this->lastQuery["players"]["max"];
        }
}
