<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table            = 'announcements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'content', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';    // Validation
    protected $validationRules      = [
        'title'   => 'required|max_length[255]|regex_match[/^[a-zA-Z0-9\s.,!?-]+$/]',  // Title: letters, numbers, spaces, and basic punctuation only
        'content' => 'required|regex_match[/^[a-zA-Z0-9\s.,!?;:()\-\n\r]+$/]',         // Content: letters, numbers, spaces, punctuation, and line breaks only
    ];
    protected $validationMessages   = [
        'title' => [
            'required'     => 'Announcement title is required.',
            'max_length'   => 'Title cannot exceed 255 characters.',
            'regex_match'  => 'Title can only contain letters, numbers, spaces, and basic punctuation.'
        ],
        'content' => [
            'required'    => 'Announcement content is required.',
            'regex_match' => 'Content can only contain letters, numbers, spaces, and standard punctuation marks.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
