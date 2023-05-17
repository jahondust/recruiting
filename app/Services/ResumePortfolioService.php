<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\ResumePortfolio;

class ResumePortfolioService
{
    /**
     * Create Portfolio.
     *
     * @param int $resume_id
     * @param array $data
     * @return ResumePortfolio
     */
    public function store(int $resume_id, array $data): ResumePortfolio
    {
        $resume = Resume::findOrFail($resume_id);

        $data['file'] = $this->upload($data['file'], 'portfolios');
        $data['resume_id'] = $resume->id;

        return ResumePortfolio::create($data);
    }

    /**
     * Update vacancy.
     *
     * @param int $resume_id
     * @param int $id
     * @param array $data
     * @return ResumePortfolio
     */
    public function update(int $resume_id, int $id, array $data): ResumePortfolio
    {
        $resume = Resume::findOrFail($resume_id);

        $data['file'] = $this->upload($data['file'], 'portfolios');
        $data['resume_id'] = $resume->id;

        $portfolio = ResumePortfolio::where('resume_id', $resume->id)->where('id', $id)->firstOrFail();
        $portfolio->update($data);

        return $portfolio;
    }

    /**
     * Delete vacancy.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return ResumePortfolio::findOrFail($id)->delete();
    }

    /**
     * Upload file.
     *
     * @param $file
     * @param $path
     * @return string
     */
    public function upload($file, $path): string
    {
        return $file->store($path);
    }
}
