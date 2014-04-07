<?php
class CampaignSteps extends CWidget
{
    public function run()
    {
        $action = Yii::app()->getController()->action->id;
        if(!isset($_GET['id']) && $action !='create') {
            echo "Redirect ...";
        }
        $id = $_GET['id'];
        
        $step1Active = ($action == 'step1') ? ' active' : '';
        $step2Active = ($action == 'step2') ? ' active' : '';
        $step3Active = ($action == 'step3') ? ' active' : '';
        $step4Active = ($action == 'step4') ? ' active' : '';
        $step5Active = ($action == 'step5') ? ' active' : '';
        
        $steps =<<< EOD
            <div class="breadcrumb-wrapper">

                <ol class="breadcrumb">
                    <li class="$step1Active"><a href="/campaign/{$id}/step1"><span class="play-steps">1</span> get amped up</a></li>
                    <li class="$step2Active"><a href="/campaign/{$id}/step2"><span class="play-steps">2</span> build campaign</a></a></li>
                    <li class="$step3Active"><a href="/campaign/{$id}/step3"><span class="play-steps">3</span> stuff funders love</a></li>
                    <li class="$step4Active"><a href="/campaign/{$id}/step4"><span class="play-steps">4</span> pump up the volume</a></li>
                    <li class="$step5Active"><a href="/campaign/{$id}/step5"><span class="play-steps">5</span> amplify your passion</a></li>
                </ol>   
            </div>
EOD;
        
        echo $steps;
    }
}