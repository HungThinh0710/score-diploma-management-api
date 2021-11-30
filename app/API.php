<?php

namespace App;

class API{
    private const DOMAIN = "localhost:3000/api/v1";

    public const LOGIN = self::DOMAIN.'/auth/login';
    public const REGISTER = self::DOMAIN.'/enrolls/register-user';
    public const REVOKE_USER = self::DOMAIN.'/enrolls/revoke-use';
    public const SUBMIT_NEW_TRANSCRIPT = self::DOMAIN.'/transcripts/new';
    public const UPDATE_TRANSCRIPT = self::DOMAIN.'/transcripts/update';
    public const GET_DETAIL_TRANSCRIPT = self::DOMAIN.'/transcripts/detail';
    public const GET_HISTORY_TRANSCRIPT = self::DOMAIN.'/transcripts/history';

}
