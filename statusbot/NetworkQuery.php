<?php

namespace statusbot;

class NetworkQuery {
        
        public $gamemodes = [];
        
        public $lastQuery = [];
        
        public function __construct(array $gamemodes) {
                $this->gamemodes = $gamemodes;
        }
        
        public function query() {
                foreach($this->gamemodes as $name => $server) {
                        $queryData = json_decode("https://mcapi.ca/query/" . $server, true);
                        $this->lastQuery[$name]["servers"]["online"] += ($queryData["status"] === true ? 1 : 0);
                        $this->lastQuery[$name]["servers"]["max"] ++;
                        $this->lastQuery[$name]["players"]["online"] += $queryData["players"]["online"];
                        $this->lastQuery[$name]["players"]["online"] += $queryData["players"]["max"];
                }
        }
        
        public function isQuery($query) {
                return is_array($query);
        }
        
        public function getOnlineServers($gamemode) {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery[$gamemode]["servers"]["online"];
        }
        
        public function getMaxServers($gamemode) {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery[$gamemode]["servers"]["max"];
        }
        
        public function getOnlinePlayers($gamemode) {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery[$gamemode]["players"]["online"];
        }
        
        public function getMaxPlayers($gamemode) {
                if(!$this->isQuery($this->lastQuery)) return null;
                return $this->lastQuery[$gamemode]["players"]["max"];
        }
        
        public function getTotalOnlineServers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                $total = 0;
                foreach($this->lastQuery as $data) {
                        $total += $this->lastQuery[$data]["servers"]["online"];
                }
                return $total;
        }
        
        public function getTotalMaxServers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                $total = 0;
                foreach($this->lastQuery as $data) {
                        $total += $this->lastQuery[$data]["servers"]["max"];
                }
                return $total;
        }
        
        public function getTotalOnlinePlayers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                $total = 0;
                foreach($this->lastQuery as $data) {
                        $total += $this->lastQuery[$data]["players"]["online"];
                }
                return $total;
        }
        
        public function getTotalMaxPlayers() {
                if(!$this->isQuery($this->lastQuery)) return null;
                $total = 0;
                foreach($this->lastQuery as $data) {
                        $total += $this->lastQuery[$data]["players"]["max"];
                }
                return $total;
        }
        
}