<?php

declare(strict_types=1);

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    private array $errors = [];


    /**
     * A constructor for the LoginForm class.
     *
     * @param array $attributes The form attributes
     */
    public function __construct(private array $attributes)
    {
        if (!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($this->attributes['password'], 7, 255)) {
            $this->errors['password'] = 'Password must be at least 7 characters with a maximum of 255';
        }
    }

    /**
     * Validate the given attributes and create a new instance of the class.
     *
     * @param array $attributes The attributes to validate
     * @throws ValidationException If the validation fails
     * @return static The new instance of the class
     */
    public static function validate(array $attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }


    /**
     * Retrieves the errors array.
     *
     * @return array The errors array.
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Throws a ValidationException with the errors and attributes of the form.
     *
     * @throws ValidationException if there are any errors in the form.
     * @return void
     */
    public function throw(): void
    {
        ValidationException::throw($this->getErrors(), $this->attributes);
    }


    /**
     * Adds an error to the login form.
     *
     * @param string $key The key of the error.
     * @param string $message The error message.
     * @return LoginForm The updated login form instance.
     */
    public function addError(string $key, string $message): LoginForm
    {
        $this->errors[$key] = $message;

        return $this;
    }

    /**
     * Check if the function has any errors.
     *
     * @return bool Returns true if there are errors, false otherwise.
     */
    private function failed(): bool
    {
        return count($this->errors) > 0;
    }
}