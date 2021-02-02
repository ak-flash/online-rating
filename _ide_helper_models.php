<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property int $user_id Moderator Id
 * @property string $name
 * @property string|null $phone
 * @property string|null $adress
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discipline[] $disciplines
 * @property-read int|null $disciplines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faculty[] $faculties
 * @property-read int|null $faculties_count
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereAddress($value)
 * @property int|null $volgmed_id
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereVolgmedId($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discipline
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_name
 * @property int $department_id
 * @property int $faculty_id
 * @property int $semester
 * @property int $last_class_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereLastClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|Discipline onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Discipline withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Discipline withoutTrashed()
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Faculty $faculty
 * @property-read string $last_class
 * @property int|null $volgmed_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topics
 * @property-read int|null $topics_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereVolgmedId($value)
 */
	class Discipline extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faculty
 *
 * @property int $id
 * @property string $name
 * @property string $tag
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $speciality
 * @method static \Illuminate\Database\Eloquent\Builder|Faculty whereSpeciality($value)
 */
	class Faculty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Journal
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property int $discipline_id
 * @property string $time_start
 * @property string $time_end
 * @property int $day_type
 * @property int $faculty_id
 * @property string $year
 * @property int|null $semester
 * @property int|null $course_number
 * @property int|null $group_number
 * @property string|null $room
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Discipline $discipline
 * @property-read \App\Models\Faculty $faculty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $study_classes
 * @property-read int|null $study_classes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDayTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereYear($value)
 * @mixin \Eloquent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|Journal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Journal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Journal withoutTrashed()
 * @property int $week_type
 * @property-read string $week
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereWeekType($value)
 * @property int $day_type_id
 * @property int $week_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereWeekTypeId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LessonStudent[] $studentLesson
 * @property-read int|null $student_lesson_count
 * @method static \Illuminate\Database\Eloquent\Builder|Journal getStudentJournal($year, $semester)
 */
	class Journal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lecture
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Lecture extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $title
 * @property int $type_id
 * @property string $date
 * @property string $time_start
 * @property string $time_end
 * @property string|null $room
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $student
 * @property-read int|null $student_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $topic_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|Lesson onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Lesson withoutTrashed()
 * @property int $journal_id
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereJournalId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Journal[] $journal
 * @property-read int|null $journal_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topic
 * @property-read int|null $topic_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $studentLesson
 * @property-read int|null $student_lesson_count
 * @property-read \App\Models\User|null $editedBy
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LessonStudent
 *
 * @property int $id
 * @property int $study_class_id
 * @property int $student_id
 * @property int $mark1
 * @property int $mark2
 * @property string|null $notify
 * @property bool $attendance
 * @property int $user_id
 * @property string|null $permission_file_path
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent newQuery()
 * @method static \Illuminate\Database\Query\Builder|LessonStudent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent owned()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereMark1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereMark2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent wherePermissionFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereStudyClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|LessonStudent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LessonStudent withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $editedBy
 * @property int $lesson_id
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereLessonId($value)
 */
	class LessonStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $document_id
 * @property string $name
 * @property int $faculty_id
 * @property int|null $course_number
 * @property int|null $group_number
 * @property string $email
 * @property string|null $password
 * @property int $active
 * @property string|null $profile_photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Faculty $faculty
 * @property-read string $profile_photo_url
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $last_name
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastName($value)
 * @property-read Collection|Lesson[] $study_classes
 * @property-read int|null $study_classes_count
 * @property-read Collection|Lesson[] $study_class
 * @property-read int|null $study_class_count
 * @property-read Collection|Lesson[] $lesson
 * @property-read int|null $lesson_count
 * @property-read Collection|Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property bool|null $chief
 * @property string|null $phone
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property string|null $date_of_birth
 * @property-read User|null $creator
 * @property-read User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read User|null $updater
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereChief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Topic
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $discipline_id
 * @property int $t_number
 * @property string $title
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|Topic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Topic withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Topic withoutTrashed()
 * @property string|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic search($search)
 */
	class Topic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $phone_number
 * @property string $position
 * @property bool $active
 * @property int|null $department_id
 * @property string|null $date_of_birth
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Journal|null $lessons
 * @property-read string $profile_photo_url
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool|null $show_phone
 * @property-read User|null $creator
 * @property-read User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Department|null $moderator_department
 * @property-read User|null $updater
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User owned()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @property int $position_id
 * @property int|null $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @property-read \App\Models\Department|null $moderatorInDepartment
 */
	class User extends \Eloquent {}
}

