<?php

/**
 * @file
 * contains \Drupal\code_challange\Form\ChallengeForm.
 */

namespace Drupal\code_challange\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Serialization\Json;


class ChallangeForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'code_challange_form';
    }
    /** 
     * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {
     
        
        $make =\Drupal::httpClient()->get('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes',[
            'query' => [
              'format' => 'json',
            ],]);
            $data = (string) $make->getBody();
            
         $output = json_decode($data);
     
         $results = $output->Results;
         $makes = [
            '2|Make' => '2|Make'
         ];
         foreach($results as $key => $value) {
            $makes[ $value->Make_ID] =  $value->Make_Name;
         }
        $options = [
            'Year' => '1|Year',
            '2023' => '2023',
            '2022' => '2022',
            '2021' => '2021',
            '2020' => '2020',
            '2019' => '2019',
            '2018' => '2018',
            '2017' => '2017',
            '2016' => '2016',
            '2015' => '2015',
            '2014' => '2014',
            '2013' => '2013',
            '2012' => '2012',
            '2011' => '2011',
            '2010' => '2010',
            '2009' => '2009',
            '2008' => '2008',
            '2007' => '2007',
            '2006' => '2006',
            '2005' => '2005',
            '2004' => '2004',
            '2003' => '2003',
            '2002' => '2002',
            '2001' => '2001',
            '2000' => '2003',
            '1999' => '1999',
            '1998' => '1998',
            '1997' => '1997',
            '1996' => '1996',
            '1995' => '1995'
        ];

        $markup = '<div class="custom-text"><div id="my-custom-markup"><h2>ADD YOUR VEHICLE</h2></div><div id="my-cust-markup">
        Get an exact fit for your vehicle.
        </p></div></div>';

        $form['field_mycustommarkup'] = [
            '#type' => 'markup',
            '#markup' => $markup,
            '#weight' => 0,            
        ];

        $form['veh_year'] = [
            '#type' => "select",
            '#options' => $options,
        ];

        $form['veh_make'] = [
            '#type' => "select",
            '#options' => $makes,
            '#ajax' => [
                'callback' => [$this, 'reloadModel'],
                'event' => 'change',
                'wrapper' => 'model-field-wrapper',
            ],
          //  '#disabled'=> TRUE
        ];

        $form['veh_model'] = [
            '#type' => "select",
            '#options' => [
                '3|Model' => ('3|model'),
            ],
            '#prefix' => '<div id="model-field-wrapper">',
            '#suffix' => '</div>',
      
        ];

        
       $form['#attached']['library'][] ='code_challange/code_challanges';
        return $form;
    }
    
    public function reloadModel(array $form, FormStateInterface $form_state) {
        $make = $form_state->getValue('veh_make');
        $model =\Drupal::httpClient()->get('https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/'.$make,[
            'query' => [
              'format' => 'json',
            ],]);
            $model_data = (string) $model->getBody();
         
         $data_output_model = json_decode($model_data);
         $model_results = $data_output_model->Results;
         
         foreach($model_results as $key => $value) {
            $models[$value->Model_ID] =  $value->Model_Name;
         }  
         $form['veh_make']['#value'] = $make;
         $makes = [
            '3|Model' => '3|Model'
         ];
         $form['veh_model']['#options'] = $models ?? ['model'=> '3|Model'];


         return $form['veh_model'];
      }
   

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        //processing data
        $this->messenger()-> addMessage($this->t("You have successfully registered."));
        foreach ($form_state->getValues() as $key => $value) {
            $this->messenger()-> addMessage($key . ': ' . $value);
        }
    }
}