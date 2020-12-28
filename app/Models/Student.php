<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory;

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function lesson($department_id)
    {
        return $this->belongsToMany(Lesson::class)
            ->where('department_id', $department_id)
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
