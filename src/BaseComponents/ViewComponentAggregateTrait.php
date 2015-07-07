<?php
namespace Presentation\Framework\BaseComponents;

use Presentation\Framework\Rendering\ViewAggregateTrait;

/**
 * Class ViewComponentAggregateTrait
 *
 * Extended ViewAggregate that implements ContainerInterface
 * @todo rename to ViewAggregateTrait
 *
 */
trait ViewComponentAggregateTrait
{
    use ContainerTrait {
        ContainerTrait::components as protected internalComponents;
        ContainerTrait::setComponents as private internalSetComponents;
    }
    use ViewAggregateTrait {
        ViewAggregateTrait::setView as protected setViewInternal;
    }

    public function render()
    {
        return $this->renderComponents(null);
    }

    public function setView(ComponentInterface $view)
    {
        if ($this->view !== null) {
            $this->internalComponents()->remove($this->view);
        }
        $this->setViewInternal($view);
        $this->internalComponents()->add($this->view);
        return $this;
    }

    public function components()
    {
        $this->useDefaultViewIfNull();
        return $this->internalComponents()->readonly();
    }
}
