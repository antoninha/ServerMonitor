<?php

namespace ServersMonitorVersionFinale\Http\Controllers;

use Spatie\UptimeMonitor\MonitorRepository;
use Spatie\UptimeMonitor\Models\Monitor;
use Spatie\UptimeMonitor\Commands\CheckUptime;
use Spatie\Url\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Console\Command;
use App\Http\Controllers\Controller;

class MonitorController extends Controller
{
    public function index(){ 
        date_default_timezone_set('Europe/Paris');     
        $this->checkuptime();         
        $monitors = Monitor::all();
        return view('monitor/list', compact('monitors'));
    }

    public function checkuptime(){
        $mymonitors = MonitorRepository::getForUptimeCheck();
        $mymonitors->checkUptime();
    }

    public function delete(){
        $monitors = Monitor::all();
        if(isset($_POST['id'])){
            $monitor = Monitor::where('id', $_POST['id'])->first();
            $monitor->delete();
            echo "<script>alert('URL supprimée');document.location='delete'</script>";
        }
        return view('monitor\delete', compact('monitors'));        
    }

    public function add(){
        if (isset($_POST['url'])){
            
            if(substr($_POST['url'],0,7)!='http://' && substr($_POST['url'],0,8)!='https://'){
                echo "<script>alert('URL invalide');document.location='add'</script>";
            }
            $url = Url::fromString($_POST['url']);
            $countUrls = Monitor::where('url', $url)->count();
            if($countUrls>0){
                echo "<script>alert('URL déjà enregistrée');document.location='add'</script>";
            }

            $lookForString = '';

            if ($url!=""){
                Monitor::create([
                    'url' => trim($url, '/'),
                    'look_for_string' => $lookForString ?? '',
                    'uptime_check_method' => isset($lookForString) ? 'get' : 'head',
                    'certificate_check_enabled' => $url->getScheme() === 'https',
                    'uptime_check_interval_in_minutes' => config('uptime-monitor.uptime_check.run_interval_in_minutes'),
                ]);
                echo "<script>alert('URL ajoutée');document.location='add'</script>";
            }
        }
    return view('monitor\add');
    }
}

