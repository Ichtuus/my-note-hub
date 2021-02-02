<?php

namespace App\GraphQL\Resolver;

use App\Repository\Note\NoteRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class NotesResolver implements ResolverInterface, AliasedInterface
{

    private NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function resolve(int $id)
    {
        $note = $this->noteRepository->find($id);
        return $note;
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Note'
        ];
    }
}
