<?php

class Site extends MX_Controller {

    protected $head_data = [];
    protected $content = [];
    
    public function __construct()
    {
        $this->head_data['css'] = [
            'css/bootstrap/bootstrap.min.css',
            'css/bootstrap/bootstrap-theme.min.css',
            'css/lte/AdminLTE.min.css',
            'css/lte/style.css',
            'css/style.css',
            ];
        $this->head_data['js'] = [
            'js/jquery/jQuery-2.1.4.min.js',
            'js/bootstrap/bootstrap.min.js',
            'js/angular/angular.min.js',
            'js/angular/angular-postfix/angular-postfix.js',
            'js/angular/bootstrap-angular-ui/ui-bootstrap-0.13.1.min.js',
            'js/angular/bootstrap-angular-ui/ui-bootstrap-tpls-0.13.1.min.js',
            'js/angular/app.js'
        ];
    }
    
    public function index($page = 'index')
    {
        $this->head_data['title'] = 'Главная страница';
        $this->content['body'] = 'Привет';
        $this->loadTemplates();
    }
    
    protected function loadTemplates()
    { 
        $this->load->view('templates/header', $this->head_data);
        $this->load->view('templates/body', $this->content);
        $this->load->view('templates/footer');
    }
}
