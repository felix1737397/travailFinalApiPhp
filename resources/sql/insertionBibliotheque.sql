USE bibliotheque;


INSERT INTO `livre` (`prenom_auteur`, `nom_famille_auteur`, `titre`, `nb_page`, `isbn`, `date_publication`, `langue`) VALUES
('J.K.', 'Rowling', 'Harry Potter and the Philosopher''s Stone', 352, 9781408855898, '1997-06-27', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Chamber of Secrets', 348, 9781408855904, '1998-07-02', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Prisoner of Azkaban', 480, 9781408855911, '1999-07-08', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Goblet of Fire', 640, 9781408855928, '2000-07-08', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Order of the Phoenix', 768 , 9781408865439, '2003-06-23', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Half-Blood Prince', 720, 9781526618290, '2005-06-16', 'English'),
('J.K.', 'Rowling', 'Harry Potter and the Deathly Hallows', 759 , 9781606868829, '2007-06-21', 'English');   

INSERT INTO `user` (`prenom_user`, `nom_user`, `cle_api`) VALUES
('Marine', 'Lepen', 'chomeuse'),
('Elliot', 'Gaulin', 'Cracko');