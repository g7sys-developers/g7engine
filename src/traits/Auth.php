<?php
namespace G7Engine\traits;
use G7Engine\Session;

trait Auth
{
    /**
     * Configurations of crypt
     * 
     * @var array
     */
    private array $passwordConfig = [
        'cost' => 12
    ];

    /**
     * Crypt password
     * 
     * @return string
     */
    protected function cryptPassword(): string
    {
        return password_hash($this->getPassword(), PASSWORD_BCRYPT, $this->passwordConfig);
    }

    /**
     * Check password
     * 
     * @param string $hash
     * @return bool
     */
    protected function checkPassword(string $hash): bool
    {
        return password_verify($this->getPassword(), $hash);
    }

    /**
     * Select user using Doctrine DBAL
     * 
     * @return array | bool
     */
    protected function selectUser() : array | bool
    {
        $db = $this->getBuilder();
        $query = $db->select('nomusu, senusu, codigo_usuario, id_accesslevel, dtavalsen, stausuati')
            ->from('tabela081')
            ->where('nomusu = ?')
            ->andWhere('stausuati = \'S\'')
            ->andWhere('dtavalsen >= CURRENT_DATE')
            ->setParameter(0, $this->getUsername());

        $result = $query->executeQuery()->fetchAssociative();
        Session::setMany($result);
        return $result;
    }

    /**
     * Check and prepare system to login
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authenticate() : bool
    {
        $user = $this->selectUser();
        if ($user) {
            if ($this->checkPassword($user['senusu'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Logout
     * 
     * @return void
     */
    public function logout() : void
    {
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_destroy();
    }

    /**
     * Check if user is logged
     * 
     * @return bool
     */
    public static function isLogged() : bool
    {
        return Session::exists();
    }
}

?>