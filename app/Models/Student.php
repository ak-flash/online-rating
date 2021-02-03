<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
class Student extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $guard = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'document_id',
        'faculty_id',
        'course_number',
        'group_number',
        'profile_photo_path',
        'active',
        'chief',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email_verified_at' => 'datetime',
    ];

    public function faculty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }



    public function lessons(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)
            ->orderByDesc('date')
            ->withPivot('id', 'mark1', 'mark2', 'notify', 'attendance', 'updated_at',  'updated_by',  'permission_file_path')
            ->withTimestamps();
    }

    public function lesson($journal_id): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)
            ->where('journal_id', $journal_id)
            ->withPivot('mark1', 'mark2', 'notify', 'attendance', 'updated_at', 'updated_by');
    }

    public static function findStudent($document_id) {
        return Student::firstWhere('document_id', $document_id);
    }

    public function logout() {

        Auth::guard('student')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get the URL to the student's profile photo thumbnail.
     *
     * @param $profilePhotoPath
     * @param bool $thumbnail
     * @return string
     */
    public function getThumbnail(): string
    {
        return Storage::disk()->url('public/profile-photos/students/thumbnails/'.$this->profile_photo_path);
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        return $this->profile_photo_path
            ? Storage::disk()->url('public/profile-photos/students/'.$this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl(): string
    {
        $user_name = explode(' ', $this->name);
        return 'https://ui-avatars.com/api/?name='.urlencode($user_name[1].' '.$user_name[0]).'&color=bedebf&background=43a047';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::where('last_name', 'ilike', '%'.$search.'%')
                ->orWhere('name', 'ilike', $search.'%')
                ->orWhere('email', 'ilike', '%'.$search.'%');
    }
}
