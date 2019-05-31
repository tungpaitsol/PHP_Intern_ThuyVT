<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bài 1 OOP</title>
</head>
<body>
    
</body>
</html>
<?php
include("OOP_Bai1.data.php");
class Employee{
    private $member_code;
    private $full_name;
    private $age;
    private $gender;
    private $marital_status;
    private $salary;
    private $start_work_time;
    private $work_hour;
    private $has_lunch_break;
    private $workdays;
    private $total_work_time;
    private $salary_actual;
    public function __construct( $member_code, $full_name, $age, $gender, $marital_status, $salary, $start_work_time, $work_hour, $has_lunch_break, $workdays=0, $total_work_time=0, $salary_actual=0){
        $this->member_code = $member_code;
        $this->full_name = $full_name;
        $this->age = $age;
        $this->gender = $gender;
        $this->marital_status = $marital_status;
        $this->salary = $salary;
        $this->start_work_time = $start_work_time;
        $this->work_hour = $work_hour;
        $this->has_lunch_break = $has_lunch_break;
        $this->workdays = $workdays;
        $this->total_work_time = $total_work_time;
        $this->salary_actual = $salary_actual;
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
    public function setSalaryActual($salary_actual){
        $this->salary_actual=$salary_actual;
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
    public function getSalaryActual(){
        return $this->salary_actual;
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
    array_push($employeefulltime,new Employee($listMemberFullTime[$i]['code'],$listMemberFullTime[$i]['full_name'],$listMemberFullTime[$i]['age'],$listMemberFullTime[$i]['gender'],$listMemberFullTime[$i]['marital_status'],$listMemberFullTime[$i]['salary'],$listMemberFullTime[$i]['start_work_time'],$listMemberFullTime[$i]['work_hour'],$listMemberFullTime[$i]['has_lunch_break']));
};

$employeeparttime = array();
for($i=0; $i<count($listMemberPartTime); $i++){
    array_push($employeeparttime,new Employee($listMemberPartTime[$i]['code'],$listMemberPartTime[$i]['full_name'],$listMemberPartTime[$i]['age'],$listMemberPartTime[$i]['gender'],$listMemberPartTime[$i]['marital_status'],$listMemberPartTime[$i]['salary'],$listMemberPartTime[$i]['start_work_time'],$listMemberPartTime[$i]['work_hour'],$listMemberPartTime[$i]['has_lunch_break']));
};

$worktime = array();
for($i=0; $i<count($listWorkTime); $i++){
    array_push($worktime, new WorkTime($listWorkTime[$i]['member_code'],$listWorkTime[$i]['start_datetime'],$listWorkTime[$i]['end_datetime']));
}

class General {
    const arr_holiday = array(
        '2019-01-01' => 'Tết dương lịch',
        '2019-02-04' => 'Tết âm lịch',
        '2019-02-05' => 'Tết âm lịch',
        '2019-02-06' => 'Tết âm lịch',
        '2019-02-07' => 'Tết âm lịch',
        '2019-02-08' => 'Tết âm lịch',
        '2019-04-15' => 'Giỗ Tổ Hùng Vương',
        '2019-04-30' => 'Giải phóng miền nam',
        '2019-05-01' => 'Quốc tế lao động',
        '2019-09-02' => 'Quốc khánh'
    );
    public function tinhcong($employee,$worktime) {
        $seconds=60*60;
        foreach ($employee as $val) {
            if($val->getHasLunchBreak())
                $lunch_break=90*60;
            else 
                $lunch_break=0;
            $count=0;
            foreach ($worktime as $value) {
                if($value->getMemberCode()==$val->getMemberCode()){
                    $Endworktime=strtotime($val->getStartWorkTime())+$val->getWorkHour()*$seconds+$lunch_break;
                    if((date("H:i:s",strtotime($value->getStartDatetime())) <= date("H:i:s",strtotime($val->getStartWorkTime())))
                        && (date("H:i:s",strtotime($value->getEndDatetime())) >= date("H:i:s",$Endworktime)))
                        $count+=1;
                    else
                        $count+=0.5;
                }
            }
            $val->setWorkDays($count);
        }
    }
    public function Holiday($arr, $currentDate) {
        if (isset($arr[$currentDate])) 
            return true;
        return false;
    }
    public function Weekend($w) {
        if(($w=="Saturday")||($w=="Sunday"))
            return true;
        return false;
    }
    public function WorkDay($y,$m){
        $days=date("t",strtotime($y.$m));
        $workday=0;
        for($i=1; $i<=$days; $i++){
            $currentDate = sprintf("%s-%02d-%02d", $y, $m, $i);
            $thu=date("l",strtotime($currentDate));
            if(General::Weekend($thu)||General::Holiday(self::arr_holiday, $currentDate))
                continue;
            $workday++;
        }
        return $workday;
    }
    public function TinhLuong($employee,$worktime){
        $month=date("m",strtotime($worktime[0]->getStartDatetime()));
        $year=date("Y",strtotime($worktime[0]->getStartDatetime()));
        $totalworkdays=General::WorkDay($year, $month);
        foreach ($employee as $value) {
            $salary_day=$value->getSalary()/$totalworkdays;
            $salary=$salary_day*$value->getWorkDays();
            $value->setSalaryActual($salary);
        }
    }
}
date_default_timezone_set("Asia/Ho_Chi_Minh");
General::tinhcong($employeefulltime,$worktime);
General::tinhcong($employeeparttime,$worktime);
General::TinhLuong($employeefulltime,$worktime);
General::TinhLuong($employeeparttime,$worktime);

echo "<pre>";
print_r($employeefulltime);
print_r($employeeparttime);
// print_r($worktime);
?>