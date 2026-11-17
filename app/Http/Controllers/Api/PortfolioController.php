<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\CertificateResource;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::query()->first();

        if ($profile === null) {
            return $this->notFound('Data profil belum dikonfigurasi.');
        }

        return ProfileResource::make($profile)
            ->additional([
                'status' => 'success',
                'message' => 'Data profil berhasil diambil.',
            ])
            ->response();
    }

    public function skills(): JsonResponse
    {
        $skills = Skill::query()->orderBy('sort')->get();

        return SkillResource::collection($skills)
            ->additional([
                'status' => 'success',
                'message' => 'Data skill berhasil diambil.',
                'total' => $skills->count(),
            ])
            ->response();
    }

    public function projects(): JsonResponse
    {
        $projects = Project::query()->orderBy('sort')->get();

        return ProjectResource::collection($projects)
            ->additional([
                'status' => 'success',
                'message' => 'Data proyek berhasil diambil.',
                'total' => $projects->count(),
            ])
            ->response();
    }

    public function projectDetail(string $slug): JsonResponse
    {
        $project = Project::query()->where('slug', $slug)->first();

        if ($project === null) {
            return $this->notFound('Data proyek tidak ditemukan.');
        }

        return ProjectResource::make($project)
            ->additional([
                'status' => 'success',
                'message' => 'Detail proyek berhasil diambil.',
            ])
            ->response();
    }

    public function experiences(): JsonResponse
    {
        $experiences = Experience::query()->orderBy('sort')->get();

        return ExperienceResource::collection($experiences)
            ->additional([
                'status' => 'success',
                'message' => 'Data pengalaman berhasil diambil.',
                'total' => $experiences->count(),
            ])
            ->response();
    }

    public function certificates(): JsonResponse
    {
        $certificates = Certificate::query()->orderBy('sort')->get();

        return CertificateResource::collection($certificates)
            ->additional([
                'status' => 'success',
                'message' => 'Data sertifikat berhasil diambil.',
                'total' => $certificates->count(),
            ])
            ->response();
    }

    public function storeMessage(StoreMessageRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $message = Message::create([
            'name' => strip_tags($validated['sender_name']),
            'email' => filter_var($validated['sender_email'], FILTER_SANITIZE_EMAIL),
            'subject' => strip_tags($validated['subject']),
            'message' => strip_tags($validated['body']),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi saya.',
            'data' => [
                'id' => $message->id,
                'sender_name' => $message->name,
                'sender_email' => $message->email,
                'subject' => $message->subject,
                'body' => $message->message,
                'created_at' => $message->created_at?->locale('id')->isoFormat('D MMMM Y, HH:mm'),
            ],
        ], 201);
    }

    private function notFound(string $message): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null,
        ], 404);
    }
}
