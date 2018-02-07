<?php namespace App\Repo;


use App\Model\Template;
use App\Model\TemplateInfo;

class TemplateRepo{

    /**
     * @var Template
     */
    private $template;
    /**
     * @var TemplateInfo
     */
    public $templateInfo;

    public function __construct(Template $template, TemplateInfo $templateInfo)
    {
        $this->template = $template;
        $this->templateInfo = $templateInfo;
    }

    public function  getTemplateByCategoryId($categoryId){
        $data = $this->template
                    ->with('templateInfo')
                    ->where('category_id',$categoryId)
                    ->paginate(200);
        return $data;
    }
    
    public function getTemplateDetailsById($id){
        $data = $this->template->with('templateInfo')->find($id);
        return $data?$data->toArray():$data;
    }

    public function getTemplateDetailsObjById($id){
        $data = $this->template->with('templateInfo')->find($id);
        return $data;
    }
    
    public function getAllTemplates(){
        $data = $this->template->with(['templateInfo','category'])->get();
        return $data;
    }

    public function storeTemplate($data){
        $this->template->name = $data['name'];
        $this->template->category_id = $data['category_id'];
        $this->template->image = $data[str_replace(' ', '_', $data['radio'])];
        $this->template->save();

        $data = array_except($data,['name','category_id','radio']);

        $this->templateInfo->template_id = $this->template->id;
        $this->templateInfo->template_info = json_encode($data);
        $this->templateInfo->save();
    }

    public function destroy($id){
        $this->template->with('templateInfo')->where('id',$id)->delete();
    }

}