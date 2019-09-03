<?php


namespace Themosis\ThemosisExtended\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Themosis\Core\Application;
use Themosis\ThemosisExtended\Constants\Plugin;

class ThemosisExtendedDocumentationController extends Controller
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var String
     */
    protected $docs_dir;

    /**
     * ThemosisExtendedDocumentationController constructor.
     * @param Application $app
     * @param Request $request
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct( Application $app, Request $request ) {
        $this->app = $app;

        $this->request = $request;

        $this->docs_dir = $this->app->make( Plugin::CONTAINER_ALIAS )->getPath( 'docs' );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $mdParser = \Parsedown::instance();

        $files = File::allFiles( $this->docs_dir );

        $topic = $this->request->get('topic')?? 'index';

        $mdContent = File::get( $this->docs_dir . "/{$topic}.md" );

        $parsedContent = $mdParser->text( $mdContent );

        return view( 'docs.index', ['files' => $files, 'content' => $parsedContent] );
    }
}