<?php

namespace App\Services;

class DataTableService
{
    /**
     * Masks an email address by replacing the local part (before the '@') with a partially obscured string.
     *
     * @param string $email The email address to mask.
     * @return string The masked email address.
     */
    public function maskEmail($email)
    {
        $parts = explode('@', $email);
        $parts[0] = substr($parts[0], 0, 3) . '*****';
        return implode('@', $parts);
    }

    /**
     * Generates a badge with the given role, formatted in uppercase.
     *
     * @param string $role The role to display in the badge.
     * @return string The HTML for the role badge.
     */
    public function generateRoleBadge($role)
    {
        return '<span class="badge bg-info text-white">' . strtoupper($role) . '</span>';
    }

    /**
     * Generates a set of action buttons for a data table row, including an edit and delete button.
     *
     * @param int $id The ID of the record to be edited or deleted.
     * @param string $route The route to the edit page for the record.
     * @return string The HTML for the action buttons.
     */
    public function generateActionButtons($id, $editRoute, $deleteRoute)
    {
        return '
            <div class="btn-group">
                <a href="' . $editRoute . '" class="btn btn-sm btn-warning btn-icon">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-danger btn-icon" onclick="deleteData(\'' . $id . '\', \'' . $deleteRoute . '\')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        ';
    }
}
