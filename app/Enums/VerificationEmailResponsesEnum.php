<?php

namespace App\Enums;

abstract class VerificationEmailResponsesEnum extends Enum
{
    const SOMETHING_WENT_WRONG = 250;
    const INVALID_CREDENTIALS = 251;
    const VALIDATION_ERROR = 252;
    const EMAIL_ALREADY_VERIFIED = 253;
    const INVALID_EMAIL_VERIFICATION_URL = 254;
    const INVALID_RESET_PASSWORD_TOKEN = 255;
}
