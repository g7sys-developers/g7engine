<?php
namespace G7Engine\traits;

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

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
     * @return array
     */
    protected function selectUser(): array
    {
        $db = $this->getBuilder();
        $query = $db->select('nomusu, senusu, codigo_usuario, id_accesslevel, dtavalsen, stausuati')
            ->from('users')
            ->where('nomusu = ?')
            ->andWhere('stausuati = \'S\'')
            ->andWhere('dtavalen >= CURRENT_DATE')
            ->setParameter(0, $this->getUsername());

        $result = $query->execute()->fetchAssociative();
        return $result;
    }

    /**
     * Creates a session for user
     * 
     * @param array $user
     * @return void
     */
    protected function createSession(array $user): void
    {
        $_SESSION['g7sys'] = $user;
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
}

?>