<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * Creates a URL-friendly slug from the given title.
     *
     * @param string $title The title to be converted to a slug.
     * @return string The generated slug.
     */
    public function createSlug(string $title): string
    {
        return Str::slug($title);
    }

    /**
     * Creates a unique URL-friendly slug from the given title, ensuring it does not conflict with existing slugs.
     *
     * @param string $title The title to be converted to a slug.
     * @param string $model The Eloquent model class to check for existing slugs.
     * @return string The generated unique slug.
     */
    public function createUniqueSlug(string $title, string $model): string
    {
        $slug = Str::slug($title);
        $count = 1;

        while ($model::where('slug', $slug)->exists()) {
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
