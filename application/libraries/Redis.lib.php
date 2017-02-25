<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Redis
 *
 * @author Administrator
 */
class Redis {
/**
*@example https://github.com/nicolasff/phpredis#__construct
**/
public function __construct(){}
/**
*@example https://github.com/nicolasff/phpredis#__destruct
**/
public function __destruct(){}
/**
*@example https://github.com/nicolasff/phpredis#connect
**/
public function connect(){}
/**
*@example https://github.com/nicolasff/phpredis#pconnect
**/
public function pconnect(){}
/**
*@example https://github.com/nicolasff/phpredis#close
**/
public function close(){}
/**
*@example https://github.com/nicolasff/phpredis#ping
**/
public function ping(){}
/**
*@example https://github.com/nicolasff/phpredis#echo
**/
//public function echo(){}
/**
*@example https://github.com/nicolasff/phpredis#get
**/
public function get(){}
/**
*@example https://github.com/nicolasff/phpredis#set
**/
public function set(){}
/**
*@example https://github.com/nicolasff/phpredis#setex
**/
public function setex(){}
/**
*@example https://github.com/nicolasff/phpredis#psetex
**/
public function psetex(){}
/**
*@example https://github.com/nicolasff/phpredis#setnx
**/
public function setnx(){}
/**
*@example https://github.com/nicolasff/phpredis#getSet
**/
public function getSet(){}
/**
*@example https://github.com/nicolasff/phpredis#randomKey
**/
public function randomKey(){}
/**
*@example https://github.com/nicolasff/phpredis#renameKey
**/
public function renameKey(){}
/**
*@example https://github.com/nicolasff/phpredis#renameNx
**/
public function renameNx(){}
/**
*@example https://github.com/nicolasff/phpredis#getMultiple
**/
public function getMultiple(){}
/**
*@example https://github.com/nicolasff/phpredis#exists
**/
public function exists(){}
/**
*@example https://github.com/nicolasff/phpredis#delete
**/
public function delete(){}
/**
*@example https://github.com/nicolasff/phpredis#incr
**/
public function incr(){}
/**
*@example https://github.com/nicolasff/phpredis#incrBy
**/
public function incrBy(){}
/**
*@example https://github.com/nicolasff/phpredis#incrByFloat
**/
public function incrByFloat(){}
/**
*@example https://github.com/nicolasff/phpredis#decr
**/
public function decr(){}
/**
*@example https://github.com/nicolasff/phpredis#decrBy
**/
public function decrBy(){}
/**
*@example https://github.com/nicolasff/phpredis#type
**/
public function type(){}
/**
*@example https://github.com/nicolasff/phpredis#append
**/
public function append(){}
/**
*@example https://github.com/nicolasff/phpredis#getRange
**/
public function getRange(){}
/**
*@example https://github.com/nicolasff/phpredis#setRange
**/
public function setRange(){}
/**
*@example https://github.com/nicolasff/phpredis#getBit
**/
public function getBit(){}
/**
*@example https://github.com/nicolasff/phpredis#setBit
**/
public function setBit(){}
/**
*@example https://github.com/nicolasff/phpredis#strlen
**/
public function strlen(){}
/**
*@example https://github.com/nicolasff/phpredis#getKeys
**/
public function getKeys(){}
/**
*@example https://github.com/nicolasff/phpredis#sort
**/
public function sort(){}
/**
*@example https://github.com/nicolasff/phpredis#sortAsc
**/
public function sortAsc(){}
/**
*@example https://github.com/nicolasff/phpredis#sortAscAlpha
**/
public function sortAscAlpha(){}
/**
*@example https://github.com/nicolasff/phpredis#sortDesc
**/
public function sortDesc(){}
/**
*@example https://github.com/nicolasff/phpredis#sortDescAlpha
**/
public function sortDescAlpha(){}
/**
*@example https://github.com/nicolasff/phpredis#lPush
**/
public function lPush(){}
/**
*@example https://github.com/nicolasff/phpredis#rPush
**/
public function rPush(){}
/**
*@example https://github.com/nicolasff/phpredis#lPushx
**/
public function lPushx(){}
/**
*@example https://github.com/nicolasff/phpredis#rPushx
**/
public function rPushx(){}
/**
*@example https://github.com/nicolasff/phpredis#lPop
**/
public function lPop(){}
/**
*@example https://github.com/nicolasff/phpredis#rPop
**/
public function rPop(){}
/**
*@example https://github.com/nicolasff/phpredis#blPop
**/
public function blPop(){}
/**
*@example https://github.com/nicolasff/phpredis#brPop
**/
public function brPop(){}
/**
*@example https://github.com/nicolasff/phpredis#lSize
**/
public function lSize(){}
/**
*@example https://github.com/nicolasff/phpredis#lRemove
**/
public function lRemove(){}
/**
*@example https://github.com/nicolasff/phpredis#listTrim
**/
public function listTrim(){}
/**
*@example https://github.com/nicolasff/phpredis#lGet
**/
public function lGet(){}
/**
*@example https://github.com/nicolasff/phpredis#lGetRange
**/
public function lGetRange(){}
/**
*@example https://github.com/nicolasff/phpredis#lSet
**/
public function lSet(){}
/**
*@example https://github.com/nicolasff/phpredis#lInsert
**/
public function lInsert(){}
/**
*@example https://github.com/nicolasff/phpredis#sAdd
**/
public function sAdd(){}
/**
*@example https://github.com/nicolasff/phpredis#sSize
**/
public function sSize(){}
/**
*@example https://github.com/nicolasff/phpredis#sRemove
**/
public function sRemove(){}
/**
*@example https://github.com/nicolasff/phpredis#sMove
**/
public function sMove(){}
/**
*@example https://github.com/nicolasff/phpredis#sPop
**/
public function sPop(){}
/**
*@example https://github.com/nicolasff/phpredis#sRandMember
**/
public function sRandMember(){}
/**
*@example https://github.com/nicolasff/phpredis#sContains
**/
public function sContains(){}
/**
*@example https://github.com/nicolasff/phpredis#sMembers
**/
public function sMembers(){}
/**
*@example https://github.com/nicolasff/phpredis#sInter
**/
public function sInter(){}
/**
*@example https://github.com/nicolasff/phpredis#sInterStore
**/
public function sInterStore(){}
/**
*@example https://github.com/nicolasff/phpredis#sUnion
**/
public function sUnion(){}
/**
*@example https://github.com/nicolasff/phpredis#sUnionStore
**/
public function sUnionStore(){}
/**
*@example https://github.com/nicolasff/phpredis#sDiff
**/
public function sDiff(){}
/**
*@example https://github.com/nicolasff/phpredis#sDiffStore
**/
public function sDiffStore(){}
/**
*@example https://github.com/nicolasff/phpredis#setTimeout
**/
public function setTimeout(){}
/**
*@example https://github.com/nicolasff/phpredis#save
**/
public function save(){}
/**
*@example https://github.com/nicolasff/phpredis#bgSave
**/
public function bgSave(){}
/**
*@example https://github.com/nicolasff/phpredis#lastSave
**/
public function lastSave(){}
/**
*@example https://github.com/nicolasff/phpredis#flushDB
**/
public function flushDB(){}
/**
*@example https://github.com/nicolasff/phpredis#flushAll
**/
public function flushAll(){}
/**
*@example https://github.com/nicolasff/phpredis#dbSize
**/
public function dbSize(){}
/**
*@example https://github.com/nicolasff/phpredis#auth
**/
public function auth(){}
/**
*@example https://github.com/nicolasff/phpredis#ttl
**/
public function ttl(){}
/**
*@example https://github.com/nicolasff/phpredis#pttl
**/
public function pttl(){}
/**
*@example https://github.com/nicolasff/phpredis#persist
**/
public function persist(){}
/**
*@example https://github.com/nicolasff/phpredis#info
**/
public function info(){}
/**
*@example https://github.com/nicolasff/phpredis#resetStat
**/
public function resetStat(){}
/**
*@example https://github.com/nicolasff/phpredis#select
**/
public function select(){}
/**
*@example https://github.com/nicolasff/phpredis#move
**/
public function move(){}
/**
*@example https://github.com/nicolasff/phpredis#bgrewriteaof
**/
public function bgrewriteaof(){}
/**
*@example https://github.com/nicolasff/phpredis#slaveof
**/
public function slaveof(){}
/**
*@example https://github.com/nicolasff/phpredis#object
**/
public function object(){}
/**
*@example https://github.com/nicolasff/phpredis#bitop
**/
public function bitop(){}
/**
*@example https://github.com/nicolasff/phpredis#bitcount
**/
public function bitcount(){}
/**
*@example https://github.com/nicolasff/phpredis#bitpos
**/
public function bitpos(){}
/**
*@example https://github.com/nicolasff/phpredis#mset
**/
public function mset(){}
/**
*@example https://github.com/nicolasff/phpredis#msetnx
**/
public function msetnx(){}
/**
*@example https://github.com/nicolasff/phpredis#rpoplpush
**/
public function rpoplpush(){}
/**
*@example https://github.com/nicolasff/phpredis#brpoplpush
**/
public function brpoplpush(){}
/**
*@example https://github.com/nicolasff/phpredis#zAdd
**/
public function zAdd(){}
/**
*@example https://github.com/nicolasff/phpredis#zDelete
**/
public function zDelete(){}
/**
*@example https://github.com/nicolasff/phpredis#zRange
**/
public function zRange(){}
/**
*@example https://github.com/nicolasff/phpredis#zReverseRange
**/
public function zReverseRange(){}
/**
*@example https://github.com/nicolasff/phpredis#zRangeByScore
**/
public function zRangeByScore(){}
/**
*@example https://github.com/nicolasff/phpredis#zRevRangeByScore
**/
public function zRevRangeByScore(){}
/**
*@example https://github.com/nicolasff/phpredis#zCount
**/
public function zCount(){}
/**
*@example https://github.com/nicolasff/phpredis#zDeleteRangeByScore
**/
public function zDeleteRangeByScore(){}
/**
*@example https://github.com/nicolasff/phpredis#zDeleteRangeByRank
**/
public function zDeleteRangeByRank(){}
/**
*@example https://github.com/nicolasff/phpredis#zCard
**/
public function zCard(){}
/**
*@example https://github.com/nicolasff/phpredis#zScore
**/
public function zScore(){}
/**
*@example https://github.com/nicolasff/phpredis#zRank
**/
public function zRank(){}
/**
*@example https://github.com/nicolasff/phpredis#zRevRank
**/
public function zRevRank(){}
/**
*@example https://github.com/nicolasff/phpredis#zInter
**/
public function zInter(){}
/**
*@example https://github.com/nicolasff/phpredis#zUnion
**/
public function zUnion(){}
/**
*@example https://github.com/nicolasff/phpredis#zIncrBy
**/
public function zIncrBy(){}
/**
*@example https://github.com/nicolasff/phpredis#expireAt
**/
public function expireAt(){}
/**
*@example https://github.com/nicolasff/phpredis#pexpire
**/
public function pexpire(){}
/**
*@example https://github.com/nicolasff/phpredis#pexpireAt
**/
public function pexpireAt(){}
/**
*@example https://github.com/nicolasff/phpredis#hGet
**/
public function hGet(){}
/**
*@example https://github.com/nicolasff/phpredis#hSet
**/
public function hSet(){}
/**
*@example https://github.com/nicolasff/phpredis#hSetNx
**/
public function hSetNx(){}
/**
*@example https://github.com/nicolasff/phpredis#hDel
**/
public function hDel(){}
/**
*@example https://github.com/nicolasff/phpredis#hLen
**/
public function hLen(){}
/**
*@example https://github.com/nicolasff/phpredis#hKeys
**/
public function hKeys(){}
/**
*@example https://github.com/nicolasff/phpredis#hVals
**/
public function hVals(){}
/**
*@example https://github.com/nicolasff/phpredis#hGetAll
**/
public function hGetAll(){}
/**
*@example https://github.com/nicolasff/phpredis#hExists
**/
public function hExists(){}
/**
*@example https://github.com/nicolasff/phpredis#hIncrBy
**/
public function hIncrBy(){}
/**
*@example https://github.com/nicolasff/phpredis#hIncrByFloat
**/
public function hIncrByFloat(){}
/**
*@example https://github.com/nicolasff/phpredis#hMset
**/
public function hMset(){}
/**
*@example https://github.com/nicolasff/phpredis#hMget
**/
public function hMget(){}
/**
*@example https://github.com/nicolasff/phpredis#multi
**/
public function multi(){}
/**
*@example https://github.com/nicolasff/phpredis#discard
**/
public function discard(){}
/**
*@example https://github.com/nicolasff/phpredis#exec
**/
public function exec(){}
/**
*@example https://github.com/nicolasff/phpredis#pipeline
**/
public function pipeline(){}
/**
*@example https://github.com/nicolasff/phpredis#watch
**/
public function watch(){}
/**
*@example https://github.com/nicolasff/phpredis#unwatch
**/
public function unwatch(){}
/**
*@example https://github.com/nicolasff/phpredis#publish
**/
public function publish(){}
/**
*@example https://github.com/nicolasff/phpredis#subscribe
**/
public function subscribe(){}
/**
*@example https://github.com/nicolasff/phpredis#psubscribe
**/
public function psubscribe(){}
/**
*@example https://github.com/nicolasff/phpredis#unsubscribe
**/
public function unsubscribe(){}
/**
*@example https://github.com/nicolasff/phpredis#punsubscribe
**/
public function punsubscribe(){}
/**
*@example https://github.com/nicolasff/phpredis#time
**/
public function time(){}
/**
*@example https://github.com/nicolasff/phpredis#eval
**/
//public function eval(){}
/**
*@example https://github.com/nicolasff/phpredis#evalsha
**/
public function evalsha(){}
/**
*@example https://github.com/nicolasff/phpredis#script
**/
public function script(){}
/**
*@example https://github.com/nicolasff/phpredis#dump
**/
public function dump(){}
/**
*@example https://github.com/nicolasff/phpredis#restore
**/
public function restore(){}
/**
*@example https://github.com/nicolasff/phpredis#migrate
**/
public function migrate(){}
/**
*@example https://github.com/nicolasff/phpredis#getLastError
**/
public function getLastError(){}
/**
*@example https://github.com/nicolasff/phpredis#clearLastError
**/
public function clearLastError(){}
/**
*@example https://github.com/nicolasff/phpredis#_prefix
**/
public function _prefix(){}
/**
*@example https://github.com/nicolasff/phpredis#_serialize
**/
public function _serialize(){}
/**
*@example https://github.com/nicolasff/phpredis#_unserialize
**/
public function _unserialize(){}
/**
*@example https://github.com/nicolasff/phpredis#client
**/
public function client(){}
/**
*@example https://github.com/nicolasff/phpredis#scan
**/
public function scan(&$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#hscan
**/
public function hscan(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zscan
**/
public function zscan(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#sscan
**/
public function sscan(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getOption
**/
public function getOption(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#setOption
**/
public function setOption(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#config
**/
public function config(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#slowlog
**/
public function slowlog(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getHost
**/
public function getHost(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getPort
**/
public function getPort(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getDBNum
**/
public function getDBNum(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getTimeout
**/
public function getTimeout(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getReadTimeout
**/
public function getReadTimeout(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getPersistentID
**/
public function getPersistentID(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#getAuth
**/
public function getAuth(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#isConnected
**/
public function isConnected(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#wait
**/
public function wait(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#pubsub
**/
public function pubsub(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#open
**/
public function open(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#popen
**/
public function popen(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#lLen
**/
public function lLen(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#sGetMembers
**/
public function sGetMembers(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#mget
**/
public function mget(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#expire
**/
public function expire(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zunionstore
**/
public function zunionstore(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zinterstore
**/
public function zinterstore(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zRemove
**/
public function zRemove(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zRem
**/
public function zRem(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zRemoveRangeByScore
**/
public function zRemoveRangeByScore(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zRemRangeByScore
**/
public function zRemRangeByScore(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zRemRangeByRank
**/
public function zRemRangeByRank(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zSize
**/
public function zSize(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#substr
**/
public function substr(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#rename
**/
public function rename(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#del
**/
public function del(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#keys
**/
public function keys(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#lrem
**/
public function lrem(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#ltrim
**/
public function ltrim(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#lindex
**/
public function lindex(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#lrange
**/
public function lrange(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#scard
**/
public function scard(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#srem
**/
public function srem(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#sismember
**/
public function sismember(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#zrevrange
**/
public function zrevrange(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#sendEcho
**/
public function sendEcho(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#evaluate
**/
public function evaluate(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}
/**
*@example https://github.com/nicolasff/phpredis#evaluateSha
**/
public function evaluateSha(&$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count, $str_key, &$i_iterator, $str_pattern, $i_count){}

}
