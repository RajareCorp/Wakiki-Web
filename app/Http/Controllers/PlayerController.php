<?php

namespace App\Http\Controllers;

use App\Models\histoEffet;
use App\Models\Player;
use App\Models\histoSort;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PlayerController extends Controller
{

    function addPlayers(Request $request)
    {
        $player = new Player;
        $player->nom = $request->input('name');
        $player->save();
        
        return view('welcome', ['logPath' => $request->input('setlog'), 'players' => Player::all() ]);
    }

    function delPlayers(Request $request)
    {
        $player = Player::find($request->input('deluser'));
        $player->delete();
        return view('welcome', ['logPath' => $request->input('setlog'), 'players' => Player::all() ]);
    }

    function init()
    {
        $fichier = fopen('log.txt', 'rb');
        return view('welcome', ['logPath' => fgets($fichier), 'players' => Player::all()]);
    }

    function setLog(Request $request)
    {   
        $path = $request->input('setlog');
        $fichier = fopen('log.txt', 'w');
        //Si path ne contient pas wakfu_chat.log :le rajoute
        if (strpos($path, 'wakfu_chat.log') === false)
            $path = $path."\wakfu_chat.log";
        fputs($fichier,$path);
        return view('welcome', ['logPath' => $path, 'players' => Player::all()]);
    }

    function resetLog(Request $request)
    {   
        if($request->input('reset') == null)
            $logPath = $request->input('reset');
        else
            $logPath = fgets(fopen('log.txt', 'rb'));

        $fichier = fopen($request->input('reset'), 'w');
        fclose($fichier);
        self::resetAllPlayer();
        Sort::truncate();
        histoSort::truncate();
        histoEffet::truncate();
        
        return view('welcome', ['logPath' => $logPath, 'players' => Player::all()]);
    }

    function calcul(Request $request)
    {   
        CalculController::Calcul(Player::all() ,$request->input('setlog'));
        $players = Player::where('id', $request->input('username'))->get();
        $sorts = histoSort::where('idPlayer', $request->input('username'))->get();
        $active = Player::find($request->input('username'));
        return view('welcome', ['logPath' => $request->input('setlog'), 'players' => Player::all(), 'sorts' => $sorts, 'active' => $active]);
    }

    static function resetAllPlayer()
    {   
        $players = Player::all();
        foreach ($players as $player) {
            $player->degat = 0;
            $player->soin = 0;
            $player->armure = 0;
            $player->nbCC = 0;
            $player->nbParade = 0;
            $player->save();
        }
    }

    function realtime(Request $request)
    {
        
        $logPath = fgets(fopen('log.txt', 'rb'));
        CalculController::Calcul(Player::all() ,$logPath);
        $players = Player::orderBy('degat', 'desc')->get();

        $latestSorts = HistoSort::select('idPlayer', DB::raw('MAX(idSort) as max_sort_id'))
        ->groupBy('idPlayer')
        ->get();
        $latestSortIds = $latestSorts->pluck('max_sort_id', 'idPlayer');
        $latestRecords = HistoSort::whereIn('idSort', $latestSortIds)->get();

        $histoLastSort = [];
        foreach ($latestRecords as $record) {
            $histoLastSort[$record->idPlayer] = $record->sort;
        }

        return view('realtime', ['logPath' => $logPath, 'players' => $players,'histoLastSort' => $histoLastSort]);
    }

    function log()
    {
        
        $logPath = fgets(fopen('log.txt', 'rb'));
        $log = fopen($logPath, 'rb');
        $total = count(file($logPath));
        return view('log', ['logPath' => $logPath,'log' => $log, 'total' => $total]);
    }

}
