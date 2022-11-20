<?php
  namespace Sebastienheyd\Boilerplate\Models;
  use Illuminate\Database\Eloquent\Model;

  class Contacts extends Model {
    protected $fillable = [
      'name',
      'phone',
      'email',
      'address',
      'content'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_messages';
  }
?>
