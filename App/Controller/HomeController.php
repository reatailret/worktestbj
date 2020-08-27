<?php
namespace Worktest\Controller;

use Worktest\Model\JobsModel;
use Worktest\Core\Request;

class HomeController extends BaseController {
    /**
     * default page
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $jobs=new JobsModel();
        $currPage=$request->get('page',1);
        $sorting_key=$request->get('sorting_key');
        $sorting_val=$request->get('sorting_val');
        $sorting_val=$sorting_val?1:0;
        $sorting=[];
        if($sorting_key && isset($jobs->validates[$sorting_key]))
        {
            $sorting=[$sorting_key=>$sorting_val];
        }
       
        $this->setViewVar('jobs',$jobs->getList($currPage,3,$sorting));
        $this->setViewVar('currPage',$currPage);
        $this->setViewVar('sortingKey',$sorting_key);
        $this->setViewVar('sortingVal',$sorting_val);
        
        return $this->view();
    }
    /**
     * job edit page
     *
     * @param Request $request
     * @return array
     */
    public function edit(Request $request)
    {
        if(!$this->isAdmin())
        {
            $this->setMessage('Вы должны авторизоваться','danger',true);
            $this->redirect('login/index');
            
        }
        $jobId=intval($request->get('id'));
        $jobs=new JobsModel();
        $job=$jobs->find($jobId);
        if(!$job)
        {
            $this->setMessage('Задача не найдена','danger',true);
            $this->redirect('home/index');
        }
        if($request->post('edit'))
        {
            $data=$request->postAll();
            if($request->post('status'))
                {
                    
                     $data['status']=1;
                }
                else
                {
                    
                     $data['status']=0;
                }
            if(!$jobs->validate($data))
            {
                $this->setMessage(implode(', ',array_map(function($val){ return $val;},$jobs->validates_errors)),'danger');
            }
            else
            {
                
               
                $modified=$job['status']==2 || $job['status']==-2 || $job['text']!=$jobs->sanitized_data['text'];
                if($data['status'])
                {
                    if($modified) $data['status']=2;
                   
                }
                else
                {
                    if($modified) $data['status']=-2;
                   
                }
               
                if($jobs->updateFromPost($jobId,$data))
                {
                    $this->setMessage('Успешно изменено','success','flash');
                    $this->redirect('home/edit&id='.$jobId);
                }
                else
                {
                    $this->setMessage($jobs->lastError,'danger');
                }
            }
        }
        $this->setViewVar('job',$job);
        return $this->view('edit');

    }
    /**
     * create job page
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        
        $jobs=new JobsModel();
        if($request->post('create'))
        {
            if(!$jobs->validate($request->postAll()))
            {
                $this->setMessage(implode(', ',array_map(function($val){ return $val;},$jobs->validates_errors)),'danger');
            }
            else
            {
                if($jobs->createFromPost($request->postAll()))
                {
                    $this->setMessage('Успешно добавлено','success','flash');
                    $this->redirect('home/index');
                }
                else
                {
                    $this->setMessage($jobs->lastError,'danger');
                }
            }
        }
        
        return $this->view('create');
    }
}