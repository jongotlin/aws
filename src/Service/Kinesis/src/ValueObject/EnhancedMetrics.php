<?php

namespace AsyncAws\Kinesis\ValueObject;

use AsyncAws\Kinesis\Enum\MetricsName;

/**
 * Represents enhanced metrics types.
 */
final class EnhancedMetrics
{
    /**
     * List of shard-level metrics.
     *
     * The following are the valid shard-level metrics. The value "`ALL`" enhances every metric.
     *
     * - `IncomingBytes`
     * - `IncomingRecords`
     * - `OutgoingBytes`
     * - `OutgoingRecords`
     * - `WriteProvisionedThroughputExceeded`
     * - `ReadProvisionedThroughputExceeded`
     * - `IteratorAgeMilliseconds`
     * - `ALL`
     *
     * For more information, see Monitoring the Amazon Kinesis Data Streams Service with Amazon CloudWatch [^1] in the
     * *Amazon Kinesis Data Streams Developer Guide*.
     *
     * [^1]: https://docs.aws.amazon.com/kinesis/latest/dev/monitoring-with-cloudwatch.html
     */
    private $shardLevelMetrics;

    /**
     * @param array{
     *   ShardLevelMetrics?: null|list<MetricsName::*>,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->shardLevelMetrics = $input['ShardLevelMetrics'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    /**
     * @return list<MetricsName::*>
     */
    public function getShardLevelMetrics(): array
    {
        return $this->shardLevelMetrics ?? [];
    }
}
