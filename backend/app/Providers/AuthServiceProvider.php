<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensCan([
            'admin' => 'Admin pages',
            'branch' => 'Branch pages',
            'courier' => 'Courier pages',
            'user' => 'User pages',
        ]);
        //brancha kendi kuryesini göster
        Gate::define('branch-own-couriers', function ($user, $courierid) {
            $districts = $user->district;
            $couriers=[];
            foreach ($districts as $district) {
                array_push($couriers,$district->courier);
            }
            $couriers=collect($couriers)->flatten();
            $couriers = $couriers->unique('id');
        $couriers = $couriers->pluck('id'); //sadece id leri çek
        $courier = \App\Courier::whereIn('id', $couriers)->findOrFail($courierid);
        return true;
    });
        //brancha kendi müşterilerini göster
        Gate::define('branch-own-users', function ($user, $userid) {
            $districts = $user->district;
            $users=[];
            foreach ($districts as $district) {
                array_push($users,$district->users);
            }
            $users=collect($users)->flatten();
            $users = $users->unique('id');
        $users = $users->pluck('id'); //sadece id leri çek
        $user = \App\User::whereIn('id', $users)->findOrFail($userid);
        return true;
    });
        //brancha kendi tasklarını göster
        Gate::define('branch-own-task', function ($user, $taskid) {
            $districts = $user->district;
            $tasks=[];
            foreach ($districts as $district) {
                array_push($tasks,$district->tasks);
            }
            $tasks=collect($tasks)->flatten();
            $tasks = $tasks->unique('id');
        $tasks = $tasks->pluck('id'); //sadece id leri çek
        $task = \App\Task::whereIn('id', $tasks)->findOrFail($taskid);
        return true;
    });
    //brancha kendi adreslerini göster
        Gate::define('branch-own-address', function ($user, $addressid) {
            $districts = $user->district;
            $addresses=[];
            foreach ($districts as $district) {
                array_push($addresses,$district->address);
            }
            $addresses=collect($addresses)->flatten();
            $addresses = $addresses->unique('id');
        $addresses = $addresses->pluck('id'); //sadece id leri çek
        $address = \App\Address::whereIn('id', $addresses)->findOrFail($addressid);
        return true;
    });
 //courier kendi taskını göster
        Gate::define('courier-own-task', function ($user, $taskid) {
            $task = \App\Task::where('courier_id', $user->id)->findOrFail($taskid);
            return true;
        });

         //usera kendi adresini göster
        Gate::define('user-own-address', function ($user, $addressid) {
            $task = \App\Address::where('user_id', $user->id)->findOrFail($addressid);
            return true;
        });
         //usera ait task ise ve user sender ise
        Gate::define('user-own-and-sender-task', function ($user, $taskid) {
            $task = \App\Task::where('sender_id', $user->id)->findOrFail($taskid);
            return true;
        });
    }
}
