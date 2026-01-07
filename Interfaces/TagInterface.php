<?php

interface TagInterface 
{
 public function addTag(Tag $tag): void;
 public function removeTag(string $tag): void;
 public function getTags(): array;
 public function AddTagToPost($tag_id, $post_id);
 public function incrementTagCount($tag_id);
 public function checkIfTagExist(string $tag): bool;
 public function hasTag(string $tag): bool;
 public function clearTags(): void;
}
