<?php
interface UserInterface
{
    public Function login($email, $password);
    public Function add(User $user);
    public Function findAll():array;
    public Function findByID($_id);
    public Function findByRole($role);
    public Function findByName($name);
    public Function suspendUser($name):bool;
    public Function activeUser($name):bool;
    public Function softDeletUser($name):bool;
}