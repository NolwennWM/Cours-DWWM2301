<main class="pageMain">
        <!-- Navigation du site -->
        <nav class="sideNavigation">
            <!-- Ajout version responsive -->
            <!-- &#9776; est le code html pour ☰ -->
            <label for="burger">&#9776;</label>
            <input type="checkbox" id="burger">
            <!-- fin ajout -->
            <menu class="navigation">
                <li><a href="./#home">Accueil</a></li>
                <li><a href="#articles">Articles</a></li>
                <li><a href="#contact">Contact</a></li>
            </menu>
        </nav>
        <!-- Articles du site -->
        <section id="articles">
            <h2>Articles du Blog:</h2>
            <article>
                <header class="articleHeader">
                    <h3>Mes Fruits et Légumes préférés</h3>
                </header>
                <div class="articleMain">
                    <p>
                        Voici quelques un de mes fruits et légumes préférés :
                    </p>
                    <div class="table">
                        <table>
                            <caption>Un tableau de fruits et légumes</caption>
                            <thead>
                                <tr>
                                    <th>Catégorie</th>
                                    <th>Nom</th>
                                    <th>Couleur</th>
                                    <th>Prix au Kilo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="4">Fruits</td>
                                    <td>Banane</td>
                                    <td rowspan="2">Jaune</td>
                                    <td>1,99€</td>
                                </tr>
                                <tr>
                                    <td>Citron</td>
                                    <td>1,50€</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Orange</td>
                                    <td>2,55€</td>
                                </tr>
                                <tr>
                                    <td>Cerise</td>
                                    <td rowspan="2">Rouge</td>
                                    <td>11,10€</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Légume</td>
                                    <td>Piment</td>
                                    <td>18,75€</td>
                                </tr>
                                <tr>
                                    <td>Carotte</td>
                                    <td>Orange</td>
                                    <td>1,55€</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Et la liste pourrait être bien plus grande.</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <footer class="articleFooter">
                    <span class="label">Publié le :</span> <time>13/03/2023</time>
                </footer>
            </article>
            <article>
                <header class="articleHeader">
                    <!-- emmet : Lorem5 -->
                    <h3>Lorem ipsum dolor sit amet.</h3>
                </header>
                <div class="articleMain">
                    <aside>
                        <p>
                            <!-- emmet : lorem10 -->
                            <strong>Lorem ipsum dolor sit,</strong> amet consectetur adipisicing elit. <b>Optio, quaerat?</b>
                        </p>
                    </aside>
                    <!-- emmet : lorem -->
                    <p>
                        <u>Lorem ipsum dolor sit amet consectetur adipisicing elit.</u> Vitae tenetur nam libero ex ad culpa animi doloribus, voluptas laudantium doloremque vero provident quo. Culpa, dolor at! Sapiente totam omnis harum.
                    </p>
                    <!-- emmet : lorem*2 -->
                    <p>
                        <em>Lorem ipsum dolor sit amet consectetur adipisicing elit. </em>Enim dolorum laborum omnis totam eligendi saepe. Cum, dolores aperiam. Necessitatibus saepe odit magni, excepturi expedita possimus voluptatibus sit voluptatum cumque a.
                        Quaerat eum ducimus ab perspiciatis sunt dignissimos natus magni adipisci error atque, delectus nisi facilis magnam repellendus quod dicta quam, accusantium vitae iusto. <i>Quisquam recusandae facilis sapiente ratione dolorum? Quaerat?</i>
                    </p>
                </div>
                <footer class="articleFooter">
                    <span class="label">Publié le :</span> <time>12/03/2023</time>
                </footer>
            </article>
            <article>
                <header class="articleHeader">
                    <h3>Photos de Vacances</h3>
                </header>
                <div class="articleMain">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate tempora iure obcaecati! Eaque reprehenderit obcaecati harum iste enim nesciunt non eius necessitatibus voluptatibus, sit veniam quod. Sit iusto sunt hic!
                        <img src="/ressources/images/paysage/phare.jpg" alt="Photo d'un phare" decoding="async" loading="lazy" height="200">
                        Aperiam corrupti dolorum cupiditate excepturi illum voluptatum ad nisi vel recusandae dicta eum amet reprehenderit cum, necessitatibus quos quam fugit minima sed eos voluptatibus? Obcaecati officiis dolore modi consequuntur porro!
                        Reprehenderit, nam. Reprehenderit nulla similique animi veritatis dicta. Ad iusto voluptatem eum distinctio minima magnam nesciunt expedita quam voluptatum quae eaque repellendus excepturi porro magni, dolore, totam enim fugit neque!
                    </p>
                    <figure>
                        <img src="/ressources/images/paysage/ville.jpg" alt="Photo d'une ville" loading="lazy" decoding="async" height="200">
                        <figcaption>Une ville lors d'un couché de soleil</figcaption>
                    </figure>
                </div>
                <footer class="articleFooter">
                    <span class="label">Publié le :</span> <time>11/03/2023</time>
                </footer>
            </article>
        </section>
    </main>