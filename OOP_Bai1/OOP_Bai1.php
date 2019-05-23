<?php
include("OOP_Bai1.data.php");
class Employee{
	private $member_code;
	private $full_name;
	private $age;
	private $gender;
	private $marital_status;
	private $total_work_time;
	private $salary;
	private $workdays;
	private $start_work_time;
	private $work_hour;
	private $has_lunch_break;
	public function __construct( $member_code, $full_name, $age, $gender, $marital_status, $total_work_time, $salary, $workdays, $start_work_time, $work_hour, $has_lunch_break){
		$this->member_code = $member_code;
		$this->full_name = $full_name;
		$this->age = $age;
		$this->gender = $gender;
		$this->marital_status = $marital_status;
		$this->total_work_time = $total_work_time;
		$this->salary = $salary;
		$this->workdays = $workdays;
		$this->start_work_time = $start_work_time;
		$this->work_hour = $work_hour;
		$this->has_lunch_break = $has_lunch_break;
	}
	public function setMemberCode($member_code){
		$this->member_code=$member_code;
	}
	public function setFullName($full_name){
		$this->full_name=$full_name;
	}
	public function setAge($age){
		$this->age=$age;
	}
	public function setGender($gender){
		$this->gender=$gender;
	}
	public function setMaritalStatus($marital_status){
		$this->marital_status=$marital_status;
	}
	public function setTotalWorkTime($total_work_time){
		$this->total_work_time=$total_work_time;
	}
	public function setSalary($salary){
		$this->salary=$salary;
	}
	public function setWorkDays($workdays){
		$this->workdays=$workdays;
	}
	public function setStartWorkTime($start_work_time){
		$this->start_work_time=$start_work_time;
	}
	public function setWorkHour($work_hour){
		$this->work_hour=$work_hour;
	}
	public function setHasLunchBreak($has_lunch_break){
		$this->has_lunch_break=$has_lunch_break;
	}
	public function getMemberCode(){
		return $this->member_code;
	}
	public function getFullName(){
		return $this->full_name;
	}
	public function getAge(){
		return $this->age;
	}
	public function getGender(){
		return $this->gender;
	}
	public function getMaritalStatus(){
		return $this->marital_status;
	}
	public function getTotalWorkTime(){
		return $this->total_work_time;
	}
	public function getSalary(){
		return $this->salary;
	}
	public function getWorkDays(){
		return $this->workdays;
	}
	public function getStartWorkTime(){
		return $this->start_work_time;
	}
	public function getWorkHour(){
		return $this->work_hour;
	}
	public function getHasLunchBreak(){
		return $this->has_lunch_break;
	}
}

class WorkTime{
	private $member_code;
	private $start_datetime;
	private $end_datetime;
	public function __construct( $member_code, $start_datetime, $end_datetime){
		$this->member_code = $member_code;
		$this->start_datetime = $start_datetime;
		$this->end_datetime = $end_datetime;
	}
	public function setMemberCode($member_code){
		$this->member_code=$member_code;
	}
	public function setStartDatetime($start_datetime){
		$this->start_datetime=$start_datetime;
	}
	public function setEndDatetime($end_datetime){
		$this->end_datetime=$end_datetime;
	}
	public function getMemberCode(){
		return $this->member_code;
	}
	public function getStartDatetime(){
		return $this->start_datetime;
	}
	public function getEndDatetime(){
		return $this->end_datetime;
	}
}

$employeefulltime = array();
for($i=0; $i<count($listMemberFullTime); $i++){
	array_push($employeefulltime,new Employee($listMemberFullTime[$i]['code'],$listMemberFullTime[$i]['full_name'],$listMemberFullTime[$i]['age'],$listMemberFullTime[$i]['gender'],$listMemberFullTime[$i]['marital_status'],$listMemberFullTime[$i]['total_work_time'],$listMemberFullTime[$i]['salary'],$listMemberFullTime[$i]['workdays'],$listMemberFullTime[$i]['start_work_time'],$listMemberFullTime[$i]['work_hour'],$listMemberFullTime[$i]['has_lunch_break']));
};

$employeeparttime = array();
for($i=0; $i<count($listMemberPartTime); $i++){
	array_push($employeeparttime,new Employee($listMemberPartTime[$i]['code'],$listMemberPartTime[$i]['full_name'],$listMemberPartTime[$i]['age'],$listMemberPartTime[$i]['gender'],$listMemberPartTime[$i]['marital_status'],$listMemberPartTime[$i]['total_work_time'],$listMemberPartTime[$i]['salary'],$listMemberPartTime[$i]['workdays'],$listMemberPartTime[$i]['start_work_time'],$listMemberPartTime[$i]['work_hour'],$listMemberPartTime[$i]['has_lunch_break']));
};

$worktime = array();
for($i=0; $i<count($listWorkTime); $i++){
	array_push($worktime, new WorkTime($listWorkTime[$i]['member_code'],$listWorkTime[$i]['start_datetime'],$listWorkTime[$i]['end_datetime']));
}




date_default_timezone_set("Asia/Ho_Chi_Minh");
function tinhcong($employee,$worktime){
	foreach ($employee as $val) {
		$count=0;
		foreach ($worktime as $value) {
			if($value->getMemberCode()==$val->getMemberCode()){
				if((strtotime($value->getStartDatetime()) <= strtotime($val->getStartWorkTime()))
					&& (date("H:i:s",strtotime($value->getEndDatetime())) >= date("H:i:s",strtotime($val->getStartWorkTime()))))
				{
					if($val->getHasLunchBreak()=="1"){
						$t = strtotime($value -> getEndDatetime()) - strtotime($value->getStartDatetime()) - 90*60;
						if($t>=$val->getWorkHour()*60*60){
							$count+=1;
						}
						else{
							$count+=0.5;
						}
					}
					else{
						$t = strtotime($value -> getEndDatetime()) - strtotime($value->getStartDatetime());
						if($t>=$val->getWorkHour()*60*60){
							$count+=1;
						}
						else{
							$count+=0.5;
						}
					}
				}
			}
		}
		$val->setWorkDays($count);
	}
}


tinhcong($employeefulltime,$worktime);
tinhcong($employeeparttime,$worktime);


echo "<pre>";
print_r($employeefulltime);
print_r($employeeparttime);
// print_r($worktime);

?>