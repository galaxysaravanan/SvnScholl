ALTER TABLE `users` ADD `profile` varchar(50) NULL DEFAULT NULL AFTER `panfile`;
ALTER TABLE `users` ADD `name` varchar(50) NULL DEFAULT NULL AFTER `full_name`;
ALTER TABLE `users` ADD `school_id` int(11) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `timetable` ADD `period_time` varchar(20) NULL DEFAULT NULL;


ALTER TABLE `students` ADD `caste` varchar(10) NULL DEFAULT NULL AFTER `phone`;
ALTER TABLE `students` ADD `religion` varchar(10) NULL DEFAULT NULL AFTER `caste`;
ALTER TABLE `students` ADD `father_occupation` varchar(40) NULL DEFAULT NULL AFTER `religion`;
ALTER TABLE `students` ADD `mother_occupation` varchar(40) NULL DEFAULT NULL AFTER `father_occupation`;
ALTER TABLE `students` ADD `mother_name` varchar(30) NULL DEFAULT NULL AFTER `mother_occupation`;
ALTER TABLE `students` ADD `father_name` varchar(30) NULL DEFAULT NULL AFTER `mother_name`;
ALTER TABLE `students` ADD `father_aadhaar` varchar(30) NULL DEFAULT NULL AFTER `father_name`;
ALTER TABLE `students` ADD `mother_aadhaar` varchar(30) NULL DEFAULT NULL AFTER `father_aadhaar`;
ALTER TABLE `students` ADD `aadhaar_file` varchar(30) NULL DEFAULT NULL AFTER `mother_aadhaar`;
ALTER TABLE `students` ADD `pan_file` varchar(30) NULL DEFAULT NULL AFTER `aadhaar_file`;
ALTER TABLE `students` ADD `smart_card` varchar(30) NULL DEFAULT NULL AFTER `pan_file`;
ALTER TABLE `students` ADD `pan_no` varchar(10) NULL DEFAULT NULL AFTER `smart_card`;
ALTER TABLE `students` ADD `pin_code` varchar(6) NULL DEFAULT NULL AFTER `pan_no`;
ALTER TABLE `students` ADD `father_mobile` varchar(10) NULL DEFAULT NULL AFTER `pin_code`;

