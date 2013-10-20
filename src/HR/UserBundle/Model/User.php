<?php
namespace HR\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use HR\OAuthBundle\Model\ConnectInterface;
use HR\PositionBundle\Model\PositionInterface;

/**
 * User Model
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class User implements UserInterface, GroupableInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $screenName;

    /**
     * @var string
     */
    protected $realName;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $birthday;

    /**
     * @var int
     */
    protected $degree;

    /**
     * @var string
     */
    protected $positionTitle;

    /**
     * @var string
     */
    protected $companyName;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $homepage;

    /**
     * @var string
     */
    protected $bio;

    /**
     * @var string
     */
    protected $avatarSmallUrl;

    /**
     * @var string
     */
    protected $avatarBigUrl;

    /**
     * @var int
     */
    protected $numPositions;

    /**
     * @var boolean
     */
    protected $emailConfirmed;

    /**
     * @var string
     */
    protected $confirmationToken;

    /**
     * @var \Datetime
     */
    protected $passwordRequestedAt;

    /**
     * @var ConnectInterface[]
     */
    protected $connects;

    /**
     * @var ArrayCollection
     */
    protected $careers;

    /**
     * @var ArrayCollection
     */
    protected $educations;

    /**
     * @var ArrayCollection
     */
    protected $skills;

    /**
     * @var ArrayCollection
     */
    protected $positions;

    /**
     * @var ArrayCollection
     */
    protected $groups;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var bool
     */
    protected $locked;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var bool
     */
    protected $expired;

    /**
     * @var \Datetime
     */
    protected $expiresAt;

    /**
     * @var bool
     */
    protected $credentialsExpired;

    /**
     * @var \Datetime
     */
    protected $credentialsExpiresAt;

    /**
     * @var \Datetime
     */
    protected $createdAt;

    /**
     * @var \Datetime
     */
    protected $lastLogin;

    /**
     * @var string
     */
    protected $lastLoginIp;

    public function __construct()
    {
        $this->locked             = false;
        $this->expired            = false;
        $this->credentialsExpired = false;
        $this->enabled            = true;
        $this->emailConfirmed     = false;
        $this->roles              = array();
        $this->salt               = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->numPositions       = 0;
        $this->createdAt          = new \Datetime();
        $this->groups             = new ArrayCollection();
        $this->connects           = new ArrayCollection();
        $this->careers            = new ArrayCollection();
        $this->educations         = new ArrayCollection();
        $this->skills             = new ArrayCollection();
        $this->positions          = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        return $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * {@inheritdoc}
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * {@inheritdoc}
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * {@inheritdoc}
     */
    public function setPositionTitle($positionTitle)
    {
        $this->positionTitle = $positionTitle;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPositionTitle()
    {
        return $this->positionTitle;
    }

    /**
     * {@inheritdoc}
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * {@inheritdoc}
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * {@inheritdoc}
     */
    public function setAvatarSmallUrl($avatarSmallUrl)
    {
        $this->avatarSmallUrl = $avatarSmallUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatarSmallUrl()
    {
        return $this->avatarSmallUrl ? : 'img/default-avatar48.png';
    }

    /**
     * {@inheritdoc}
     */
    public function setAvatarBigUrl($avatarBigUrl)
    {
        $this->avatarBigUrl = $avatarBigUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatarBigUrl()
    {
        return $this->avatarBigUrl ? : 'img/default-avatar128.png';
    }

    /**
     * {@inheritdoc}
     */
    public function incrementNumPositions($by)
    {
        $this->numPositions += intval($by);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function subtractNumPositions($by)
    {
        if ($this->numPositions > 0) {
            $this->numPositions -= intval($by);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getNumPositions()
    {
        return $this->numPositions;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailConfirmed($boolean)
    {
        $this->emailConfirmed = $boolean;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmailConfirmed()
    {
        return $this->emailConfirmed;
    }

    /**
     * {@inheritdoc}
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setPasswordRequestedAt(\DateTime $date = null)
    {
        $this->passwordRequestedAt = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPasswordRequestNonExpired($ttl)
    {
        return $this->passwordRequestedAt instanceof \DateTime && $this->passwordRequestedAt->getTimestamp() + $ttl > time();
    }

    /**
     * {@inheritdoc}
     */
    public function addConnect(ConnectInterface $connect)
    {
        if (!$this->connects->contains($connect)) {
            $this->connects->add($connect);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeConnect(ConnectInterface $connect)
    {
        if ($this->connects->contains($connect)) {
            $this->connects->removeElement($connect);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnects()
    {
        return $this->connects;
    }

    /**
     * {@inheritdoc}
     */
    public function getCareers()
    {
        return $this->careers;
    }

    /**
     * {@inheritdoc}
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * {@inheritdoc}
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * {@inheritdoc}
     */
    public function addPosition(PositionInterface $position)
    {
        $this->positions->add($position);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removePosition(PositionInterface $position)
    {
        $this->positions->removeElement($position);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        $roles = $this->roles;

        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }

        $roles[] = static::ROLE_DEFAULT;

        return array_unique($roles);
    }

    /**
     * {@inheritdoc}
     */
    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGroups()
    {
        return $this->groups ? : $this->groups = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupNames()
    {
        $names = array();
        foreach ($this->getGroups() as $group) {
            $names[] = $group->getName();
        }

        return $names;
    }

    /**
     * {@inheritdoc}
     */
    public function hasGroup($name)
    {
        return in_array($name, $this->getGroupNames());
    }

    /**
     * {@inheritdoc}
     */
    public function addGroup(GroupInterface $group)
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeGroup(GroupInterface $group)
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($boolean)
    {
        $this->enabled = (Boolean)$boolean;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(static::ROLE_SUPER_ADMIN);
    }

    /**
     * {@inheritdoc}
     */
    public function setSuperAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole(static::ROLE_SUPER_ADMIN);
        } else {
            $this->removeRole(static::ROLE_SUPER_ADMIN);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocked($boolean)
    {
        $this->locked = (Boolean)$boolean;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return !$this->locked;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpired($expired)
    {
        $this->expired = (Boolean)$expired;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        if (true == $this->expired) {
            return false;
        }

        if (null !== $this->expiresAt && $this->expiresAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpiresAt(\Datetime $datetime)
    {
        $this->expiresAt = $datetime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCredentialsExpired($boolean)
    {
        $this->credentialsExpired = $boolean;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCredentialsExpiresAt(\Datetime $datetime)
    {
        $this->credentialsExpiresAt = $datetime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        if (true == $this->credentialsExpired) {
            return false;
        }

        if (null !== $this->credentialsExpiresAt && $this->credentialsExpiresAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastLoginIp($lastLoginIp)
    {
        $this->lastLoginIp = $lastLoginIp;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastLoginIp()
    {
        return $this->lastLoginIp;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(UserInterface $user)
    {
        return null !== $user && $this->getId() === $user->getId();
    }

    public function serialize()
    {
        return serialize(array(
            $this->password,
            $this->salt,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
        ));
    }

    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->password,
            $this->salt,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id
            ) = $data;
    }
}