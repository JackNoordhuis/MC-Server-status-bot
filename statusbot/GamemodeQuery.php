<?php

namespace statusbot;

class GamemodeQuery {
        
        public $servers = [];
        
        public $lastQuery = [];
        
        public function __construct(array $servers) {
                $this->servers = $servers;
        }
        
        public function query() {
                foreach($this->servers as $server) {
                        $queryData = json_decode(file_get_contents("https://mcapi.ca/query/" . $server), true);
                        $this->lastQuery["servers"]["online"] += ($queryData["status"] === true ? 1 : 0);
                        $this->lastQuery["servers"]["max"]++;
                        $this->lastQuery["players"]["online"] += $queryData["players"]["online"];
                        $this->lastQuery["players"]["max"] += $queryData["players"]["max"];
                }
        }
        
        public function isQuery($query) {
                return is_array($query);
        }
        
        public function getOnlineServers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery["servers"]["online"];
        }
        
        public function getMaxServers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery["servers"]["max"];
        }
        
        public function getOnlinePlayers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery["players"]["online"];
        }
        
        public function getMaxPlayers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery["players"]["max"];
        }
        
}
