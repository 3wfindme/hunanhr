<?php
namespace HR\Bundle\UserBundle\Model;

/**
 * User Model
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class User implements UserInterface
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
    protected $avatarUrl;

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

    public function __construct()
    {
        $this->locked             = false;
        $this->expired            = false;
        $this->credentialsExpired = false;
        $this->enabled            = true;
        $this->roles              = array();
        $this->salt               = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
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
        return $this->setPlainPassword(null);
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
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
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
        $roles   = $this->roles;
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
    public function setEnabled($boolean)
    {
        $this->enabled = (Boolean)$boolean;

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
     * @param boolean $boolean
     *
     * @return $this
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
}