<?php
namespace HR\Bundle\UserBundle\ModelManager;
use HR\Bundle\UserBundle\Model\PositionInterface;
use HR\Bundle\UserBundle\Model\UserInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface PositionManagerInterface
{
    /**
     * @param UserInterface $user
     *
     * @return PositionInterface
     */
    public function createPosition(UserInterface $user);

    /**
     * @param PositionInterface $position
     *
     * @return void
     */
    public function updatePosition(PositionInterface $position);

    /**
     * @param UserInterface $user
     *
     * @return PositionInterface
     */
    public function findPositionByUser(UserInterface $user);

    /**
     * @param int $positionId
     *
     * @return PositionInterface
     */
    public function findPositionById($positionId);

    /**
     * @param PositionInterface $position
     *
     * @return void
     */
    public function deletePosition(PositionInterface $position);

    /**
     * @return string
     */
    public function getClass();
}