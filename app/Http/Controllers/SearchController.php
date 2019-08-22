<?php

namespace App\Http\Controllers;

use app\Search;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function index()
    {
        /* return home page with search field */
        return view('welcome');
    }

    public function show(Request $request)
    {
        /* build query string details */
        $q = $request->input('q');
        $page = $request->input('page');
        $ch = curl_init();
        $limit= 30;
        $url = "https://api.github.com/search/repositories?q=".$q."&sort=stars&order=desc&per_page=".$limit."&page=".$page;
        $languages = [];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 1 = TRUE
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        /* end build query string details */

        /* get results */
        $results = curl_exec($ch);
        /* create JSON Object from results */
        $repositories = json_decode($results);
        /* close conntection */
        curl_close($ch);

        /* Check to ensure the items key is pressent */
        if(property_exists($repositories, "items")){
            $items = $repositories->items;
             /* Create the languages object, loop through all the items and count how many differnt programin languages exist */
            foreach($items as $item)
            {
                if (array_key_exists ($item->language, $languages)){
                    /* If language exists increment count */
                    $languages[$item->language] += 1;
                }else{
                    /* else create new object with count of 1 */
                    $languages[$item->language] = 1;
                }
            }
            /* Sort languages from largest to smallest */
            arsort($languages);
            /* Return view with data to display to user */
            return view('search')->withQuery($q)->withTotal($repositories->total_count)->withRepositories($items)->withLanguages($languages)->withCurrent($page)->withLimit($limit);
        }
        else{
            /* If and error, return to homepage and display message */
            return view ('welcome')->withMessage('Something went, try another search!');
        }
    }
}
