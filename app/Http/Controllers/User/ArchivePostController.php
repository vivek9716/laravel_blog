<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades;
use App\Model\user\category_post;

class ArchivePostController extends Controller {

    public function index() {
        $posts = post::select(
                        \DB::raw('YEAR(created_at) as year'), \DB::raw('MONTH(created_at) as month'), \DB::raw('MONTHNAME(created_at) as month_name'), \DB::raw('COUNT(*) as post_count')
                )
                ->groupBy('year')
                ->groupBy(\DB::raw('MONTH(created_at)'))
                ->orderBy('year', 'DESC')
                ->orderBy('month', 'DESC')
                ->get();

        $data = array();
        foreach ($posts as $post) {
            $year = $post['year'];
            $month_name = $post['month_name'];
            $month = $post['month'];
            $postCount = $post['post_count'];
            if (array_key_exists($year, $data)) {
                $data[$year]['total_post'] += $postCount;
            } else {
                $data[$year]['total_post'] = $postCount;
            }
            $data[$year]['months'][$month_name] = array(
                'count' => $postCount,
                'month' => $month,
            );
        }

        $postByCategory = category_post::select('categories.name', 'categories.slug', \DB::raw('COUNT(category_posts.category_id) as post_count'))->groupBy('category_posts.category_id')
                ->join('categories', 'category_posts.category_id', '=', 'categories.id')
                ->get();
        
        return view('user.archive', compact('data', 'postByCategory'));
    }

    public function getPostByYear(Request $request) {
        $year = $request->year;
        $posts = post::with('likes')->where('status', 1)->where(\DB::raw('YEAR(created_at)'), $year)->orderBy('created_at', 'DESC')->paginate(20);
        return view('user.blog', compact('posts'));
    }

    public function getPostByYearMonth(Request $request) {
        $year = $request->year;
        $month = $request->month;
        $posts = post::with('likes')->where('status', 1)->where(\DB::raw('YEAR(created_at)'), $year)->where(\DB::raw('MONTH(created_at)'), $month)->orderBy('created_at', 'DESC')->paginate(20);
        return view('user.blog', compact('posts'));
    }

}
