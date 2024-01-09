<?php

class Question {
    public $name = '';
    public $description = '';
    public $pos  = '';
    public $id = '';
    public $options = '';
	public $course = '';
	public $survey = '';

    function __construct($name,$description,$pos,$options,$id,$course) {           
        $this->name = $name;
        $this->description = $description;
        $this->pos = $pos; 
        $this->id = $id;
        $this->options = $options;
		$this->course = $course;
		$this->survey = $survey;          
    }               
}

?>