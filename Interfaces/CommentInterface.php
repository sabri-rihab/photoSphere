<?php

interface CommentInterface
{
 public function addComment(Comment $comment);
 public function removeComment(int $_id);
 public function getComments(): array;
 public function getCommentCount(): int;
}