<?php

namespace AsyncAws\Lambda\Input;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class DeleteFunctionRequest extends Input
{
    /**
     * The name of the Lambda function or version.
     *
     * **Name formats**
     *
     * - **Function name** – `my-function` (name-only), `my-function:1` (with version).
     * - **Function ARN** – `arn:aws:lambda:us-west-2:123456789012:function:my-function`.
     * - **Partial ARN** – `123456789012:function:my-function`.
     *
     * You can append a version number or alias to any of the formats. The length constraint applies only to the full ARN.
     * If you specify only the function name, it is limited to 64 characters in length.
     *
     * @required
     *
     * @var string|null
     */
    private $functionName;

    /**
     * Specify a version to delete. You can't delete a version that an alias references.
     *
     * @var string|null
     */
    private $qualifier;

    /**
     * @param array{
     *   FunctionName?: string,
     *   Qualifier?: string,
     *
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->functionName = $input['FunctionName'] ?? null;
        $this->qualifier = $input['Qualifier'] ?? null;
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getFunctionName(): ?string
    {
        return $this->functionName;
    }

    public function getQualifier(): ?string
    {
        return $this->qualifier;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = ['content-type' => 'application/json'];

        // Prepare query
        $query = [];
        if (null !== $this->qualifier) {
            $query['Qualifier'] = $this->qualifier;
        }

        // Prepare URI
        $uri = [];
        if (null === $v = $this->functionName) {
            throw new InvalidArgument(sprintf('Missing parameter "FunctionName" for "%s". The value cannot be null.', __CLASS__));
        }
        $uri['FunctionName'] = $v;
        $uriString = '/2015-03-31/functions/' . rawurlencode($uri['FunctionName']);

        // Prepare Body
        $body = '';

        // Return the Request
        return new Request('DELETE', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setFunctionName(?string $value): self
    {
        $this->functionName = $value;

        return $this;
    }

    public function setQualifier(?string $value): self
    {
        $this->qualifier = $value;

        return $this;
    }
}
