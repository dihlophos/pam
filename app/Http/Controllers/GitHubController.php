<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitHubController extends Controller
{
    /**
     * Get github webhook.
     *
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        $commands = base_path()."/build.sh > ".base_path()."/public/buildresults.html 2>&1";
        shell_exec($commands);
    }

    /**
     * Show last github webhook action result.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
    	return redirect('/buildresults.html');
    }
}
