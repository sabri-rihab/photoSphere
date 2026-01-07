<?php

interface CommentInterface
{
 public function addComment(Comment $comment);
 public function removeComment(int $_id);
 public function getComments(): array;
 public function getCommentsByPostID($_id): array;
 public function getCommentCount(): int;
}