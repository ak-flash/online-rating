<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 */
class Student extends Model
{
    use HasFactory;

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function study_classes() {
        return $this->hasMany(StudyClass::class);
    }

    public function lesson($discipline_id)
    {
        return $this->belongsToMany(StudyClass::class);
    }

    public function les_son($discipline_id)
    {
        return $this->belongsToMany(StudyClass::class)
            ->where('lesson_id', $discipline_id)
            ->withPivot('mark1', 'mark2', 'notify', 'attendance', 'user_id', 'updated_at');
    }

    public static function findStudent($document_id) {
        return Student::firstWhere('document_id', $document_id);
    }

    public function logout() {

        session()->forget('student');

        //dd(session('student_id'));
        return redirect('/');
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $user_name = explode(' ', $this->name);
        return 'https://ui-avatars.com/api/?name='.urlencode($user_name[1].' '.$user_name[0]).'&color=bedebf&background=43a047';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }
}
