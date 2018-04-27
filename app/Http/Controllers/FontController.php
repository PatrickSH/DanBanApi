<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Font;

class FontController extends Controller
{

    private $google_font_api_key;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->google_font_api_key = "AIzaSyCwQeKSZ3uS0CfXX3Xsolva6rl--EAqj5U";
    }

    /**
     * Fetches all fonts from google font library
     */
    public function fetchGoogleFonts()
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $fonts = file_get_contents("https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=".$this->google_font_api_key, false, stream_context_create($arrContextOptions));

        Font::create(['font' => $fonts]);
    }

    /**
     * Get Fonts we have from google.
     * @return mixed
     */
    public function getGoogleFonts()
    {
        return Font::all()->first()->font;
    }

}
