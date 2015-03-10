<?php
namespace admin\straps;

class FilterEffectChain extends \admin\ngrest\StrapAbstract implements \admin\ngrest\StrapInterface
{
    public function render()
    {
        return $this->view->render("@admin/views/strap/FilterEffectChain", [
            'effectModel' => new \admin\models\StorageEffect()
        ]);
    }
    
    public function callbackAddEffect($effectId, $effectArguments)
    {
        $model = new \admin\models\StorageFilterChain();
        
        $model->setAttributes([
            "filter_id" => $this->getItemId(),
            "effect_id" => $effectId,
            "effect_json_values" => $effectArguments,
        ]);
        
        if ($model->save()) {
            return $this->response(true, []);
        }
        
        return $this->response(false, $model->getErrors());
    }
}